<?php

namespace App\Services\CSV;

use App\Jobs\HouseDbUpdateJob;

class HouseCSVParser extends CSVStreamReader
{
    public function getColumnNames(): array
    {
        $key = $this->getFile()->key();

        if ($key = ! 0) {
            $this->getFile()->seek(0);
        }

        $row = $this->getFile()->fgets();

        $this->getFile()->seek($key);

        $keys = \str_getcsv($row, ...$this->getFile()->getCsvControl());

        $result = [];

        foreach ($keys as $key => $value) {
            $result[] = \strtolower($value);
        }

        return $result;
    }

    public function handle($elements): void
    {
        // dispatchSync only for test. In production method will be dispatch
        HouseDbUpdateJob::dispatchSync($elements);
    }

    public function make($data): array
    {
        // In future big not test work,
        // I prefer to use my own array handler class. Laravel collections are slow. In the test task, we simply return an array.
        return \array_merge($data, ['created_at' => now(), 'updated_at' => now()]);
    }

    public function seed(): void
    {
        try {
            $columnNames = $this->getColumnNames();

            $toInsert = [];

            foreach ($this->read() as $key => $row) {

                $element = \array_combine($columnNames, $row);

                // chunk to 1000
                $toInsert[] = $this->make($element);

                if (count($toInsert) > 1000) {

                    $this->handle($toInsert);

                    $toInsert = [];
                }
            }

            if ( ! empty($toInsert)) {
                $this->handle($toInsert);
            }

        } catch (\Throwable $th) {
            dump($th, $columnNames, $row);
            $this->setFile(null);
        }

        $this->setFile(null);
    }
}
