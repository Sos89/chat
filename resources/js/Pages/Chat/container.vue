<template>
    <AppLayout title="Dashboard">
        <template #header>

        </template>

        <div class="py-12 text-center">
            <div class="max-w-5xl sm:px-4 lg:px-4 flex m-auto">
                <div class="shadow-xl w-48 bg-gray-200">
                    <div class="online_users m-2" v-for="friend in onlineFriends">
                        <img class="h-10 w-10 rounded-full object-cover" :src="friend.profile_photo_url" >
                        {{ friend.name }} <div class="span"></div>
                    </div>
                </div>
                <div class="shadow-xl">
                    <message-container :messages="messages" />
                    <input-message
                        :room="currentRoom"
                        v-on:messagesent="getMessages()"
                        />
                </div>
                <div class="shadow-xl">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <chat-room-selection
                            v-if="currentRoom.id"
                            :rooms="chatRooms"
                            :currentRoom="currentRoom"
                            v-on:roomChanged="setRoom( $event )"
                        />
                    </h2>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import MessageContainer from "./messageContainer";
import InputMessage from "./inputMessage";
import ChatRoomSelection from "./chatRoomSelection";
import Users from "./users";
export default {
    name: "container",
    props: ['users'],
    components: {
        Users,
        AppLayout,
        InputMessage,
        MessageContainer,
        ChatRoomSelection,
    },
    data: function (){
      return {
          chatRooms: [],
          currentRoom: [],
          messages: [],
          onlineFriends: []
      }
    },
    watch: {
        currentRoom( val, oldVal ){
            if ( oldVal.id ){
                this.disconnect( oldVal );
            }
            this.connect();
        }
    },
    methods: {
        connect(){
            if ( this.currentRoom.id ) {
                let vm = this;
                this.getMessages();

                Echo.join(`plchat`).here((users) => {
                    console.log('online_users',users)
                    this.onlineFriends=users;
                }).joining((user) => {
                    this.onlineFriends.push(user)
                    console.log('joining', user.name )
                }).leaving((user) => {
                    this.onlineFriends.splice(this.onlineFriends.indexOf(user),1);
                    console.log('leaving', user.name )
                })

                window.Echo.private("chat." + this.currentRoom.id )
                    .listen('.message.new', e => {
                        vm.getMessages();
                    })
            }
        },
        disconnect( room ) {
            window.Echo.leave("chat." + room.id );
        },
        getRooms(){
            axios.get('/chat/rooms')
                .then(response => {
                this.chatRooms = response.data;
                this.setRoom( response.data[0]);
            })
                .catch( error => {
                    console.log( error )
                })
        },
        setRoom ( room ) {
            this.currentRoom = room;

        },
        getMessages(){
            axios.get('/chat/room/' + this.currentRoom.id + '/messages')
                .then(response => {
                    this.messages = response.data;
                })
                .catch( error => {
                    console.log( error );
                })
        },

    },
    created() {
        this.getRooms();
    }
}
</script>

<style scoped>
.online_users{
    background: #a09e9e;
    display: flex;
    align-items: center;
    justify-content: space-around;
}
.span{
    background-color: green;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
}
</style>
