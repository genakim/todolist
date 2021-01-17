<template>
    <div v-if="isVisible">
        <div ref="dialog" class="opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div @click="close" class="absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div v-bind:style="{ backgroundColor: listColor}" class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <!-- Dialog -->
                <div class="py-4 text-left px-6">
                    <!--Title-->
                    <div class="pb-3">
                        <p @input="titleChange"
                           contenteditable="true"
                           class="text-2xl font-bold"
                        ><span class="border-b border-b-1 border-dashed border-black">{{title}}</span></p>
                    </div>
                    <!--Items-->
                    <list-item
                           :key="item.timestamp"
                           v-for="item in items"
                           v-bind="item"
                           @change="onListItemChange"
                           @remove="onListItemRemove"
                    />
                    <!--Controls-->
                    <footer class="flex justify-end mt-2">
                        <button @click="addItem" class="px-4 bg-indigo-500 rounded-lg text-white hover:bg-indigo-400">+</button>
                        <span class="flex-grow"></span>
                        <label>
                            Color:
                            <select v-model="color">
                                <option v-for="(value, color) in colors" :value="color">{{color}}</option>
                            </select>
                        </label>
                        <span class="flex-grow"></span>
                        <button @click="save" class="px-4 bg-indigo-500 rounded-lg text-white hover:bg-indigo-400">Save</button>
                        <button @click="close" class="px-4">Cancel</button>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Color from '../core/Colors'
    import ListItem from "../core/ListItem";
    import List from "../core/List";

    export default {
        data: () => {
            return {
                isVisible: false,
                id: null,
                title: '',
                color: 'DEFAULT',
                phantom: false,
                colors: [],
                items: []
            }
        },
        computed: {
            listColor () {
                return Color.get(this.color)
            }
        },
        created() {
            this.colors = Color.all()
        },
        methods: {
            show() {
                this.toggleVisible(true)
            },
            close() {
                this.toggleVisible(false)
            },
            toggleVisible(isVisible) {
                this.isVisible = isVisible
                this.$nextTick(() => {
                    const dialog = this.$refs.dialog;
                    if (dialog) {
                        dialog.classList.toggle('opacity-0')
                        dialog.classList.toggle('pointer-events-none')
                    }
                })
            },
            save() {
                this.$store.commit('saveList', {
                    id: this.id,
                    type: List.type,
                    title: this.title,
                    color: this.color,
                    phantom: this.phantom,
                    items: this.items
                })
                this.close()
            },
            setData(data) {
                this.id = data.id
                this.title = data.title
                this.color = data.color
                this.items = data.items ? JSON.parse(JSON.stringify(data.items)) : []
            },
            titleChange(e) {
                this.title = e.target.innerText
            },
            // List Item
            addItem() {
                const item = ListItem.create(this.id)
                this.items.push(item)
            },
            onListItemChange(id, payload, timestamp) {
                const item = this.items.find(item => item.id === id)
                item[payload.prop] = payload.value
                item.timestamp = timestamp
            },
            onListItemRemove(id) {
                const index = this.items.findIndex(item => item.id === id)
                if (index !== -1) {
                    this.items.splice(index, 1)
                }
            },
        }
    }
</script>