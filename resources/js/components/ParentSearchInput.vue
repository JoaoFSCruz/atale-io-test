<template>
    <div class="flex flex-col">
        <div class="flex items-center">
            <label class="text-xl tracking-wide" for="search">
                Search for a parent by email
            </label>
            <span class="ml-8 text-red-600" v-if="error">
                {{ error }}
            </span>
        </div>

        <div class="relative">
            <input
                class="relative w-full rounded-lg mt-2 px-6 py-4 text-2xl text-gray-900 bg-gray-50 border border-gray-800"
                type="search"
                id="search"
                name="search"
                v-model="searchQuery"
                @keyup="search()"
                @focus="this.show = true"
                @blur="blurred"
            >
            <div class="absolute w-full mt-1 border shadow-sm rounded-lg bg-gray-50 max-h-56 overflow-y-auto z-40" v-if="users.length > 0 && show">
                <ul v-for="user in users" :key="user.email">
                    <li class="cursor-pointer px-3 py-2 text-base hover:bg-gray-100 md:px-6 md:py-3 md:text-xl" @mousedown="selectUser(user.email)">{{ user.email }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import _ from "lodash";

    export default {
        props: {
            label: String,
            route: String,
            error: String
        },

        data() {
            return {
                searchQuery: '',
                users: [],
                show: false
            }
        },

        methods: {
            getUsers: _.debounce((context) => {
                axios.get('/users', {
                    params: {
                        query: context.searchQuery
                    }
                })
                    .then((response) => {
                        context.users = response.data;
                        context.show = context.users.length > 0;
                    })
                    .catch((error) => console.log(error.response));
            }, 350),

            search() {
                this.users = [];
                this.show = false;

                if (this.searchQuery) {
                    this.getUsers(this);
                }
            },

            selectUser(email) {
                this.show = false;
                this.searchQuery = email;
                this.$emit('parent-selected', this.searchQuery);
            },

            blurred() {
                this.show = false;
                this.$emit('parent-selected', this.searchQuery);
            }
        }
    }
</script>