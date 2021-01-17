<template>
    <div class="flex items-center">
        <input type="checkbox"
               v-model="itemChecked"
               class="mr-2"
               :disabled="disabled"
        >
        <p ref="text"
           contenteditable="!disabled"
           @input="textChange"
           class="flex-grow"
           v-bind:class="{'line-through': itemChecked}"
        >
            {{itemText}}
        </p>
        <div class="cursor-pointer" @click="remove" v-if="!disabled">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'id',
            'text',
            'checked',
            'timestamp',
            'disabled'
        ],
        data() {
          return {
              itemText: this.text,
              itemChecked: this.checked
          }
        },
        watch: {
            itemChecked() {
                this.change('checked', this.itemChecked)
            }
        },
        methods: {
            textChange(e){
                this.change('text', e.target.innerText)
            },
            change (prop, value) {
                this.$emit('change', this.id, {prop, value}, +new Date())
            },
            remove() {
                this.$emit('remove', this.id)
            }
        }
    }
</script>
