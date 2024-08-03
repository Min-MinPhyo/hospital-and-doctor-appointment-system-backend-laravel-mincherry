<script setup>

import { formatDate } from '../../helper';
import { ref } from 'vue';
import axios from 'axios';
import { useToastr } from '../../toastr';
import { bool } from 'yup';
const userIdBeingDeleted=ref(null);
const toastr=useToastr();


const props=defineProps({
    user:Object,
    index:Number,
    selectAll:Boolean
});

const emit=defineEmits(['userDeleted','editUser']);





const deleteUser=()=>{
    axios.delete(`/api/users/${userIdBeingDeleted.value}`)
    .then(()=>{

        $('#deleteUserModal').modal('hide');
        toastr.success('User Deleted Successfully !');
        emit('userDeleted',userIdBeingDeleted.value);

    })

}

const confirmUserDeletion=(user)=>{
    userIdBeingDeleted.value=user.id;
    $('#deleteUserModal').modal('show');

}


const roles=ref([
    {
        name:'ADMIN',
        value:1
    },

    {
        name:'USER',
        value:2
    }
])


const changeRole=(user,role)=>{

   axios.patch(`/api/users/${user.id}/change-role`,{
    role:role,
   })

   .then(()=>{
    toastr.success("Role Chage Successfully");
   })

}


const toggleSelection=()=>{
    emit('toggleSelection',props.user);
}



</script>



<template>

    <tr>
        <td><input type="checkbox" :checked="selectAll" @change="toggleSelection"/></td>
        <td>{{index +1 }}</td>
        <td>{{user.name}}</td>
        <td>{{user.email}}</td>
        <td>{{formatDate(user.created_at)}}</td>
        <td>

            <select class="form-control" @change=changeRole(user,$event.target.value)>
                <option v-for="role in roles" :value="role.value" :selected="user.role ===role.name"  :key="role.id">{{role.name}}</option>

            </select>



        </td>






        <td>

            <a href="" @click.prevent="$emit('editUser',user)">
                <i class="fa fa-edit"></i>
            </a>


            <a href="" @click.prevent="confirmUserDeletion(user)">
                <i class="fa fa-trash text-danger ml-2"></i>
            </a>



        </td>

    </tr>




    <!-- delete modal -->


    <div class="modal fade" id="deleteUserModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <!-- <span v-if="editing">Edit User</span> -->
                    <span>Delete User</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <!-- start form -->

            <div class="modal-body">

                <h5>Are you sure want to delete this  user?</h5>

            </div>

            <div class="modal-footer">


                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button @click.prevent="deleteUser" type="button" class="btn btn-danger">Delete User</button>


        </div>

               <!-- end form -->
        </div>
    </div>
</div>



    <!-- end delete modal -->

</template>
