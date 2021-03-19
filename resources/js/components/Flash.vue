<template>
    <div class="w-3/4 px-6 py-4 mb-12 bg-green-100 text-green-900 rounded-lg lg:w-1/2" v-show="show">
        <div class="flex justify-between">
            <span class="text-xl">{{ message }}</span>
            <span class="text-base underline cursor-pointer" @click="redirectToWelcomePage()">Go give it a try!</span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                show: false,
                message: '',
                goToWelcomePage: false
            }
        },

        created() {
            window.emmiter.on('flash', data => this.flash(data));
        },

        methods: {
            flash(data) {
                if(data) {
                    this.message = data.message;
                }
                this.show = true;
            },

            redirectToWelcomePage() {
                window.location.href = '/';
            }
        }
    }
</script>