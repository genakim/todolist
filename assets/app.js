import "tailwindcss/tailwind.css"
import './styles/app.pcss';

import Vue from 'vue'
import Vuex from 'vuex'
import List from './core/List'

import ListComponent from "./components/List";
import ListDialogComponent from "./components/ListDialog";
import ListItemComponent from "./components/ListItem";
import ToolboxComponent from "./components/Toolbox";

Vue.component('toolbox', ToolboxComponent)
Vue.component('list', ListComponent)
Vue.component('list-item', ListItemComponent)
Vue.component('list-dialog', ListDialogComponent)

Vue.use(Vuex)

let app = null

const store = new Vuex.Store({
    state: {
        lists: []
    },
    mutations: {
        setLists (state, lists) {
            state.lists = lists
        },
        createList () {
            /** @type {ListDialogComponent} */
            const dialog = app.$root.$refs.dialog
            dialog.setData(List.create())
            dialog.show()
        },
        removeList (state, listId) {
            const index = state.lists.findIndex(
                item => item.id === listId
            )
            state.lists.splice(index, 1)
        },
        saveList (state, payload) {
            const lists = state.lists

            if (payload.phantom) {
                state.lists.push(payload)
            } else {
                const index = lists.findIndex(
                    list => list.id === payload.id
                )
                lists.splice(index, 1, payload)
            }

            app.saveListItems(payload)
        }
    }
})

app = new Vue({
    el: '#app',
    store,
    computed: {
      lists () {
          return store.state.lists.filter(
              item => item.type === List.type
          )
      }
    },
    created () {
        const lists = [
            {
                id: 1,
                type: 'LIST',
                title: "Title 1",
                color: 'YELLOW',
                parent_id: 'root'
            },
            {
                id: 2,
                type: 'LIST_ITEM',
                text: 'My text',
                checked: false,
                parent_id: 1
            }
        ]
        store.commit('setLists', lists)
    },
    methods: {
        saveListItems(payload)
        {
            const lists = store.state.lists
            const itemsToCreate = payload.items
            const itemsToRemove = lists.filter(
                list => list.parent_id === payload.id
            )

            itemsToRemove.forEach(item => {
                const index = lists.findIndex(
                    list => list.id === item.id
                )
                lists.splice(index, 1)
            })

            itemsToCreate.forEach((item) => {
                lists.push(item)
            })
        }
    }
})
