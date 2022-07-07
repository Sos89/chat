<template>
    <div class="">
        <div class="select_room">
<!--            <select-->
<!--                v-model="selected"-->
<!--                @change="$emit('roomChanged', selected)"-->
<!--                class="float-right select">-->
<!--                <option-->
<!--                    v-for="(room, index ) in rooms"-->
<!--                    :key="index"-->
<!--                    :value=" room "-->
<!--                    >-->
<!--                    {{ room.name }} {{ room.description}}-->
<!--                </option>-->
<!--            </select>-->
            <jet-button
                v-model="selected"
                v-for="(room, index ) in rooms"
                :key="index"
                @change="$emit('roomChanged', selected)"

            >
                {{ room.name }} {{ room.description}}
            </jet-button>
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
        console.log(this.selected = this.currentRoom)
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
    width: 200px;
    text-align: center;
    font-size: 20px;
    background: #5171f3;
    border-radius: 10px;
}
option{
    width: 100%;
    font-size: 18px;
    background: #edddd5;
    cursor: pointer!important;
}
.select:hover{
    background: #244df4;
    cursor: pointer;
}
</style>
