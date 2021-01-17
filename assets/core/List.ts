export default class List {
    static type = 'LIST'

    static create(): Object
    {
        return {
            id: +new Date(),
            type: List.type,
            title: "Title",
            color: "DEFAULT",
            phantom: true // is new record
        }
    }
}