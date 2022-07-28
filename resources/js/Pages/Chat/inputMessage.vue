<template>
    <div class="relative h-10 m-1">
        <div class="grid grid-cols-6">
            <input
                type="text"
                v-model="message"
                @keyup.enter="sendMessage()"
                placeholder="See something..."
                class="col-span-5 outline-none p-1 grid"
            />
            <button
                @click="sendMessage()"
                class="place-self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white">
                Send
            </button>
        </div>
    </div>
</template>

<script>
import Input from '../../Jetstream/Input.vue'
export default {
    name: "inputMessage",
    components: {Input},
    props: ['room'],
    data: function (){
        return {
            message: '',
            messages: ''
        }
    },
    methods: {
        messageRequired(value) {
            if (value && value.trim()) {
                return true;
            }
            return 'Message is required !';
        },
        sendMessage() {
            if ( this.message == ' ') return;

            axios.post('/chat/room/' + this.room.id + '/message', {
                message: this.message,
            })
                .then( response =>  {
                    if (response.status == 201) {
                        this.message = '';
                        this.$emit('messageSend');
                    }
                })
                .catch( error => {
                    this.messages = error.response.data
            })
        }
    }
}
</script>

<style scoped>
.grid{
    border-radius: 10px;
    border-top: 1px solid #e6e6e6
}
</style>
