<template>
    <div
         @click="showDialog"
         class="rounded-lg border border-gray-100 p-4"
         v-bind:style="{backgroundColor: listColor}"
    >
        <header class="flex mb-1">
            <h2 class="text-lg font-medium title-font flex-grow">{{title}}</h2>
            <div @click="remove" class="p-2 cursor-pointer">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </div>
        </header>
        <list-item v-for="item in items" v-bind="item" :key="item.timestamp" disabled="true"/>
    </div>
</template>

<script>
    import Color from "../core/Colors"
    import ListItem from "../core/ListItem"

    export default {
        props: [
            'id',
            'title',
            'color'
        ],
        computed: {
            listColor () {
                return Color.get(this.color)
            },
            items () {
                return this.$store.state.lists.filter(
                    item => {
                        return item.parent_id === this.id
                            && item.type === ListItem.type
                    }
                )
            }
        },
        methods: {
            showDialog () {
                const dialog = this.$root.$refs.dialog
                dialog.setData({
                    id: this.id,
                    title: this.title,
                    color: this.color,
                    phantom: this.phantom,
                    items: this.items
                })
                dialog.show()
            },
            remove(e)
            {
                e.stopPropagation()
                this.$store.commit('removeList', this.id)
            }
        }
    }
</script>
