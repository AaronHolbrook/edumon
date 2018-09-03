<template>
    <div class="sm:w-3/4" v-show="user.name">
        <div class="score float-right bg-white rounded shadow float-right p-4">
            {{ user.name }}: {{ parseInt( user.score || 0 ) }}
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Points',
        data() {
            return {
                user: {
                    name: '',
                    score: null
                }
            }
        },
        methods: {
            getUser() {
                axios.get(`/api/get-user`)
                    .then(response => {
                        this.user.name = response.data.name
                        this.user.score = response.data.score
                    })
            }
        },
        created() {
            this.getUser()
        }
    }
</script>

<style scoped>
    .score {
        text-transform:capitalize;
    }
</style>