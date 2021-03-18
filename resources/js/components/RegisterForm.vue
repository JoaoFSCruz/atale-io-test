<template>
    <div class="w-3/4 flex flex-col pb-12 lg:w-1/2">
        <h1 class="text-3xl md:text-4xl">
            Create your <span class="text-yellow-400">record</span>
        </h1>

        <p class="text-gray-400 text-xl mt-4 md:text-2xl">You can choose only one parent, but multiple children. You can also leave it all blank, it's up to you.</p>

        <p class="text-gray-400 text-xl mt-4 md:text-2xl">Choose wisely as it is not possible to change later.</p>

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

        <div class="mt-12 space-y-12">
            <parent-search-input @parent-selected="setParent" :error="errors.hasOwnProperty('parent') ? errors.parent[0] : null"></parent-search-input>

            <children-search-input @child-selected="setChildren" :error="errors.hasOwnProperty('children') ? errors.children[0] : null"></children-search-input>
        </div>

        <button
            class="px-6 py-4 bg-yellow-400 text-gray-800 uppercase text-2xl rounded-lg mt-12 font-semibold hover:bg-yellow-500 md:text-2xl md:mt-12"
            @click="register()"
        >
            Create Record
        </button>
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
                parent: '',
                children: [],
                errors: {}
            }
        },

        methods: {
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
        }
    }
</script>