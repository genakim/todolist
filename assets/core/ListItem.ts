export default class ListItem {
    static type = 'LIST_ITEM'

    static create(parent_id: number): Object
    {
        const timestamp = +new Date()
        return {
            id: timestamp,
            type: ListItem.type,
            text: "My Text",
            checked: false,
            parent_id: parent_id,
            timestamp
        }
    }
}