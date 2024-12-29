<?php

namespace App\Services\CSV;

class CSVStreamReader
{
    public function __construct(
        private ?\SplFileObject $file,
    ) {
        $file->setFlags($file::READ_CSV);
        $file->setFlags($file::READ_AHEAD);
        $file->setFlags($file::SKIP_EMPTY);
    }

    public function getFile(): \SplFileObject
    {
        return $this->file;
    }

    public function setFile($file): static
    {
        $this->file = $file;

        return $this;
    }

    public function setCsvControl(
        string $separator = ',',
        string $enclosure = '"',
        string $escape = '\\',
    ): static {
        $this->file->setCsvControl($separator, $enclosure, $escape);

        return $this;
    }

    public function read(): \Generator
    {
        while ( ! $this->file->eof()) {
            $row = $this->file->fgets();
            if (strlen($row) > 0) {
                yield str_getcsv($row, ...$this->file->getCsvControl());
            }
        }
    }
}
