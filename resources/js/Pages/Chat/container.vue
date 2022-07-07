<template>
    <AppLayout title="Dashboard">
        <template #header>
<!--            <Link-->
<!--                :href="route('admin')"-->
<!--                class="ml-2 text-indigo-600 hover:text-indigo-900"-->
<!--            >-->
<!--                Admin-->
<!--            </Link>-->
        </template>

        <div class="py-12 text-center">
            <div class="max-w-4xl sm:px-4 lg:px-4 flex m-auto">
                <div class="shadow-xl w-48 bg-gray-200">
                    <div class="online_users m-2" v-for="friend in onlineFriends">
                        <img class="h-10 w-10 rounded-full object-cover" :src="friend.profile_photo_url" >
                        <div class="span"></div> {{ friend.name }}
                    </div>
                </div>
                <div class="shadow-xl">
                    <message-container :messages="messages"/>
                    <input-message
                        :room="currentRoom"
                        @messagesent="getMessages()"
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
import {Link} from "@inertiajs/inertia-vue3";
export default {
    name: "container",
    props: ['users'],
    components: {
        Users,
        AppLayout,
        InputMessage,
        MessageContainer,
        ChatRoomSelection,
        Link,
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
                    this.onlineFriends=users;
                }).joining((user) => {
                    this.onlineFriends.push(user)
                }).leaving((user) => {
                    this.onlineFriends.splice(this.onlineFriends.indexOf(user),1);
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
    background: #f6f4f2;
    display: flex;
    align-items: center;
    border-radius: 5px;
}
.span{
    background-color: #71f171;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin: 10px;
}
</style>
