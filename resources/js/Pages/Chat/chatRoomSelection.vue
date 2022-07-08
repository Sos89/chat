<template>
    <div class="">
        <div class="select_room">
            <select
                v-model="selected"
                @change="$emit('roomChanged', selected)"
                class="float-right select bg-gray-600" >
                <option
                    v-for="(room, index ) in rooms"
                    :key="index"
                    :value=" room "
                    >
                    {{ room.name }} {{ room.description}}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button.vue'
export default {
    name: "chatRoomSelection",
    components: {
        JetButton,
    },
    props: ['rooms', 'currentRoom'],
    data: function (){
        return{
            selected: '',
        }
    },
    created(){
        this.selected = this.currentRoom;
    },
}
</script>

<style scoped>
.select_room{
    display: flex;
    flex-direction: column;
    margin: 10px;
}
.select{
    text-align: center;
    font-size: 20px;
    border-radius: 10px;
}
option{
    width: 100%;
    font-size: 18px;
    background: rgb(31 41 55 / var(--tw-bg-opacity));
    margin-top: 11px !important;
    cursor: pointer!important;
}
.select:hover{
    cursor: pointer;
    background: #282d35;
    color: #809cc0;
}
</style>
