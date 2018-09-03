<template>
    <div class="bg-white rounded shadow p-6 m-4 sm:w-3/4">
        <h1 class="mb-4 text-grey-darkest">Word System</h1>

        <div v-show="message" class="p-4 mt-4 mb-4 text-white rounded" :class="messageType">{{ message }}</div>

        <div class="mb-4 text-5xl text-center">
            <code>{{ word }}</code>
        </div>

        <div class="border-grey-lighter border-2 p-4 mb-4" v-for="definition in definitions">
            <p>
                {{ definition }}
            </p>
            <button class="p-2 border-2 rounded text-teal border-teal hover:text-white hover:bg-teal btn-blue mt-4"
                    @click="selectAnswer( definition )">
                Choose
            </button>
        </div>

        <button class="float-right  p-2 border-2 rounded text-teal border-teal hover:text-white hover:bg-teal btn-blue mt-2"
                @click="getQuestion">
            New Question
        </button>
    </div>
</template>

<script>
    export default {
        name: 'WordSystem',
        data() {
            return {
                message: '',
                messageType: '',
                word: '',
                correctDefinition: false,
                definitions: [],
                wrongAnswerCount: 0,
            }
        },
        methods: {
            getQuestion() {
                axios.get(`/api/get-question`)
                    .then(response => {
                        this.word = response.data.word
                        this.correctDefinition = response.data.correctDefinition,
                            this.definitions = response.data.definitions
                        this.message = ''
                        this.messageType = ''
                    })
            },
            selectAnswer(definition) {
                if (definition === this.correctDefinition) {
                    this.messageType = 'bg-green'
                    this.message = 'Correct!'

                    axios.post(`/api/correct-answer`, {
                        user_id: 1
                    })
                        .then(response => {
                            window.location.reload()
                        })
                } else {
                    this.messageType = 'bg-red'
                    this.message = 'Incorrect'

                    if ( this.wrongAnswerCount >= 1 ) {
                        window.location.reload()
                    }

                    this.wrongAnswerCount++
                }
            }
        },
        created() {
            this.getQuestion()
        }
    }
</script>

<style scoped lang="scss">
</style>