<template>
    <div id="app" class="pt-4 pb-4 flex flex-col items-center justify-center bg-grey-light font-sans">
        <score></score>
        <words></words>
    </div>
</template>

<script>
    import Score from './components/score'
    import Words from './components/Words'

    export default {
        components: {
            Score,
            Words
        }
    }
</script>