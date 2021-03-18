<template>
    <div class="flex flex-col">
        <div class="flex items-center">
            <label class="text-xl tracking-wide" for="search">
                Search for a child by email
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
                @blur="this.show = false"
            >
            <div class="absolute w-full mt-1 border shadow-sm rounded-lg bg-gray-50 max-h-56 overflow-y-auto z-40" v-if="users.length > 0 && show">
                <ul v-for="user in users" :key="user.email">
                    <li class="flex items-center cursor-pointer px-3 py-2 text-base hover:bg-gray-100 md:px-6 md:py-3 md:text-xl" @mousedown="addChild(user.email)">
                        <svg class="w-6 h-6 mr-2 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        {{ user.email }}
                    </li>
                </ul>
            </div>

            <template v-if="children.length > 0">
                <p class="text-lg text-gray-400 mt-2">Selected children:</p>
                <ul v-for="child in children">
                    <li class="flex items-center">
                        <span class="text-xl mr-4">{{ child }}</span>
                        <svg class="w-6 h-6 cursor-pointer" @click="removeChild(children.indexOf(child))" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </li>
                </ul>
            </template>
        </div>
    </div>
</template>

<script>
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
            children: [],
            show: false
        }
    },

    methods: {
        search() {
            this.users = [];
            this.show = false;

            axios.get('/users', {
                params: {
                    query: this.searchQuery
                }
            })
                .then((response) => {
                    this.users = response.data;
                    this.show = this.users.length > 0;
                })
                .catch((error) => console.log(error.response));
        },

        addChild(email) {
            this.show = false;

            for (let child of this.children) {
                if (child === email) {
                    return;
                }
            }

            this.children.push(email);
            this.searchQuery = '';
            this.$emit('child-selected', this.children)
        },

        removeChild(index) {
            this.children.splice(index, 1);
        }
    }
}
</script>