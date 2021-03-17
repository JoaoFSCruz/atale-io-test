<template>
    <div>
        <h1 class="text-4xl">
            Find out your <span class="text-yellow-400">ascendants</span> and <span class="text-yellow-400">descendants</span>.
        </h1>

        <template v-if="! results">
            <p class="text-gray-400 text-2xl mt-12">First, let's verify if you have a record in our database.</p>

            <div class="flex flex-col mt-2">
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

            <template v-if="showCompleteForm">
                <p class="text-3xl text-gray-900 mt-12">Looks like you don't. So let's create one! Please fill the following form.</p>

                <p class="text-gray-400 text-2xl mt-12">Do you have a parent? You can select one parent or leave this blank.</p>

                <parent-search-input @parent-selected="setParent" :error="errors.hasOwnProperty('parent') ? errors.parent[0] : null"></parent-search-input>

                <p class="text-gray-400 text-2xl mt-12">Do you have a child or children? You can select as many children as you want or leave this blank.</p>

                <children-search-input @child-selected="setChildren"></children-search-input>
            </template>

            <div class="flex justify-end">
                <button
                    class="px-6 py-4 bg-yellow-400 text-gray-800 uppercase text-2xl rounded-lg mt-12 font-semibold hover:bg-yellow-500"
                    v-if="! showCompleteForm"
                    @click="checkUserExists()"
                >
                    Check
                </button>

                <div v-else class="flex space-x-4">
                    <button
                        class="px-6 py-4 bg-gray-600 text-gray-50 uppercase text-2xl rounded-lg mt-12 font-semibold hover:bg-gray-800"
                        @click="reload()"
                    >
                        Back
                    </button>
                    <button
                        class="px-6 py-4 bg-yellow-400 text-gray-800 uppercase text-2xl rounded-lg mt-12 font-semibold hover:bg-yellow-500"
                        @click="register()"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </template>

        <template v-else>
            <p class="text-3xl text-gray-900 mt-12">Looks like you do. Check your results!</p>
            <div class="flex space-x-16 mt-8">
                <div class="flex flex-col items-center">
                    <p class="text-3xl rounded-lg font-semibold">
                        {{ results.ascendants }}
                    </p>
                    <p class="text-2xl">Ascendants</p>
                </div>
                <div class="flex flex-col items-center">
                    <p class="text-3xl rounded-lg font-semibold">
                        {{ results.descendants }}
                    </p>
                    <p class="text-2xl">Descendants</p>
                </div>
            </div>

            <button
                class="px-6 py-4 bg-yellow-400 text-gray-800 uppercase text-2xl rounded-lg mt-12 font-semibold hover:bg-yellow-500"
                @click="reload()"
            >
                Back
            </button>
        </template>
    </div>
</template>

<script>
    import ParentSearchInput from './ParentSearchInput';
    import ChildrenSearchInput from './ChildrenSearchInput';

    export default {
        components: {
            ParentSearchInput,
            ChildrenSearchInput
        },

        data() {
            return {
                email: '',
                errors: {},
                parent: '',
                children: [],
                showCompleteForm: false,
                results: null
            }
        },

        methods: {
            checkUserExists() {
                this.showCompleteForm = false;
                this.errors = {};
                axios.post('/users/check', { email: this.email})
                    .then((response) => this.results = response.data)
                    .catch((error) => {
                        if (error.response.status === 404) {
                            this.showCompleteForm = true;
                            return;
                        }

                        this.errors = error.response.data.errors;
                    });
            },

            register() {
                axios.post('/users', {
                    email: this.email,
                    parent: this.parent,
                    children: _.cloneDeep(this.children)
                })
                    .then((response) => this.results = response.data)
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            },

            setParent(parentEmail) {
                this.parent = parentEmail;
            },

            setChildren(children) {
                this.children = children;
            },

            reload() {
                window.location.reload();
            }
        }
    }
</script>