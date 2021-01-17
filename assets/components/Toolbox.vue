<template>
    <div class="shadow-md mb-3 p-3 flex">
        <button @click="createList" class="px-4 bg-indigo-500 rounded-lg text-white hover:bg-indigo-400">+</button>
    </div>
</template>

<script>
    export default {
        methods: {
            createList () {
                this.$store.commit('createList')
            }
        }
    }
</script>
