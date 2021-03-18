<template>
    <div class="w-3/4 flex flex-col pb-12 lg:w-1/2">
        <h1 class="text-3xl md:text-4xl">
            Find out your <span class="text-yellow-400">ascendants</span> and <span class="text-yellow-400">descendants</span>
        </h1>

        <p class="text-gray-400 text-xl mt-4 md:text-2xl">By introducing your email, we will check our records to fetch your family count.</p>

        <div class="flex flex-col mt-4 md:mt-12">
            <div class="flex items-center">
                <label class="text-xl tracking-wide" for="email">Email</label>
                <span class="ml-8 text-red-600" v-if="errors.hasOwnProperty('email')">{{ errors.email[0] }}</span>
            </div>
            <input
                class="rounded-lg mt-2 px-6 py-4 text-2xl text-gray-900 bg-gray-50 border border-gray-800"
                type="text"
                id="email"
                name="email"
                v-model="email"
            >
        </div>

        <button
            class="px-6 py-4 bg-yellow-400 text-gray-800 uppercase text-lg rounded-lg mt-8 font-semibold hover:bg-yellow-500 md:text-2xl md:mt-12"
            @click="getFamilyCount()"
        >
            Get Family Count
        </button>

        <div class="flex justify-center">
            <p class="text-xl md:text-2xl mt-12 text-gray-600">
                Don't have a record yet?
                <a class="text-yellow-400 underline cursor-pointer hover:text-yellow-500" href="/users/create">Create one!</a>
            </p>
        </div>

        <template v-if="results">
            <div class="flex space-x-24 mt-24 justify-center">
                <div class="flex flex-col items-center">
                    <p class="text-5xl rounded-lg font-semibold">
                        {{ results.ascendants }}
                    </p>
                    <p class="text-3xl mt-4">Ascendants</p>
                </div>
                <div class="flex flex-col items-center">
                    <p class="text-5xl rounded-lg font-semibold">
                        {{ results.descendants }}
                    </p>
                    <p class="text-3xl mt-4">Descendants</p>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                results: null,
                errors: {}
            }
        },

        methods: {
            getFamilyCount() {
                this.showCompleteForm = false;
                this.errors = {};
                axios.post('/get-family-count', { email: this.email })
                    .then((response) => this.results = response.data)
                    .catch((error) => {
                        console.log(error.response)
                        if (error.response.status === 404) {
                            this.showCompleteForm = true;
                            return;
                        }

                        this.errors = error.response.data.errors;
                    });
            },
        }
    }
</script>