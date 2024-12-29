<script setup>
import { reactive, ref } from "vue"
import axios from "axios"
import { isNumber } from "../purejs/service/helpers.js"

const response = reactive({})

const isLoading = ref(false)

async function getHouses() {
    response.houses = {}
    isLoading.value = true

    axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"

    const aHouseParams = getHouseParams(houseParams)

    console.log(aHouseParams)
    axios
        .get("/api/houses", { params: aHouseParams })
        .then((resp) => {
            setTimeout(() => (isLoading.value = false), 200)
            response.houses = resp.data.data.houses
        })
        .catch((error) => console.log(error))
}

function getHouseParams(houseParams) {
    const result = {}
    for (const param in houseParams) {
        if (houseParams[param] != null) {
            result[param] = houseParams[param]
        }
    }
    return result
}

const houseParams = reactive({
    name: null,
    price_from: null,
    price_to: null,
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null,
})
</script>

<template>
    <div class="main_margin">
        <h2>Search houses</h2>
        <p>Enter parameters to search for houses</p>
        <div>
            <div class="label_div">Name</div>
            <input class="input_class" type="text" v-model="houseParams.name" />
        </div>

        <div>
            <div class="label_div">Price (from - to)</div>
            <input @keypress="isNumber" class="input_class" type="number" v-model="houseParams.price_from" min="0" />
            <input
                style="margin-left: 0.5em"
                @keypress="isNumber"
                class="input_class"
                type="number"
                v-model="houseParams.price_to"
                min="0" />
        </div>

        <div>
            <div class="label_div">Bedrooms</div>
            <input @keypress="isNumber" class="input_class" type="number" v-model="houseParams.bedrooms" min="0" />
        </div>

        <div>
            <div class="label_div">Bathrooms</div>
            <input @keypress="isNumber" class="input_class" type="number" v-model="houseParams.bathrooms" min="0" />
        </div>

        <div>
            <div class="label_div">Storeys</div>
            <input @keypress="isNumber" class="input_class" type="number" v-model="houseParams.storeys" min="0" />
        </div>
        <div>
            <div class="label_div">Garages</div>
            <input @keypress="isNumber" class="input_class" type="number" v-model="houseParams.garages" min="0" />
        </div>

        <button v-if="isLoading == false" class="button_class" @click="getHouses">Search</button>

        <div class="spinner" v-show="isLoading"></div>

        <div class="table_div" v-if="response.houses?.data?.length == 0">
            {{ "No matching matches found" }}
        </div>
        <div class="table_div" v-if="response.houses?.data?.length">
            <div style="display: flex">
                <div class="house_row">Name</div>
                <div class="house_row">Price</div>
                <div class="house_row">Bathrooms</div>
                <div class="house_row">Bedrooms</div>
                <div class="house_row">Storeys</div>
                <div class="house_row">Garages</div>
            </div>
            <template v-for="house in response.houses.data">
                <div style="display: flex">
                    <div class="house_row">
                        {{ house.name }}
                    </div>
                    <div class="house_row">
                        {{ house.price }}
                    </div>
                    <div class="house_row">
                        {{ house.bathrooms }}
                    </div>
                    <div class="house_row">
                        {{ house.bedrooms }}
                    </div>
                    <div class="house_row">
                        {{ house.storeys }}
                    </div>
                    <div class="house_row">
                        {{ house.garages }}
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
