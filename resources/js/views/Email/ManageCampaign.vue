<template>
    <div>
        <div class="card card-custom">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title d-flex gap-5">
                    <h3>Manage Campaign</h3>
<!--                    <RequestLoading :isShow="loading" text="Loading...."/>-->
                </div>
                <RouterLink class="btn btn-primary" to="/email-marketing">Add New Campaign</RouterLink>
            </div>
        </div>

        <div class="mt-5">
            <div v-if="batches.length" class="card my-2 w-100 overflow-hidden" v-for="(batch, i) in batches">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <div>
                                <h2>{{ batch?.name }}</h2>
                                <p>Campaign Id: <strong>{{ batch?.id }}</strong></p>
                            </div>
                            <div>
                                <h2>Progress: {{ batch?.progress }} %</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <h2>Job Details</h2>
                            <div class="d-flex gap-5 w-100 justify-content-between">
                                <p class="p-0 m-0">Total Jobs:</p>
                                <span class="badge bg-light-primary text-primary">{{ batch?.totalJobs }}</span>
                            </div>
                            <div class="d-flex gap-5 w-100 justify-content-between">
                                <p class="p-0 m-0">Pending Jobs:</p>
                                <span class="badge bg-light-primary text-primary">{{ batch?.pendingJobs }}</span>
                            </div>
                            <div class="d-flex gap-5 w-100 justify-content-between">
                                <p class="p-0 m-0">Processed Job:</p>
                                <span class="badge bg-light-primary text-primary">{{ batch?.processedJobs }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <h2>Start / End</h2>
                            <div class="d-flex gap-5 w-100 justify-content-between">
                                <p class="p-0 m-0">Created At:</p>
                                <span class="badge bg-light-info text-info fw-bold">{{ moment(batch?.createdAt).format('lll') }}</span>
                            </div>
                            <div class="d-flex gap-5 w-100 justify-content-between">
                                <p class="p-0 m-0">Finished At:</p>
                                <span class="badge bg-light-primary text-primary">{{ moment(batch?.finishedAt)?.format('lll')  }}</span>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-warning" @click="deleteCampaing(batch?.id)">Delete Job</button>
                        </div>
                    </div>
                </div>
                <div class="border-5 border-warning border-bottom" :style="`width:${batch?.progress}%`">

                </div>
            </div>
            <h1 v-else>No Campaign Exist....</h1>
        </div>

    </div>
</template>

<script setup>

import RequestLoading from "@/components/RequestLoading.vue";
import {onMounted, ref} from "vue";
import useAxios from "@/composables/useApi.js";
import moment from "moment";

const {sendRequest, error, loading} = useAxios();
const batches = ref([])

const getAllCampaigns = async () => {
    batches.value = await sendRequest("api/get-all-campaign");
}

setInterval(async function () {
    if(batches.value?.[0]?.progress < 100){
        await getAllCampaigns()
    }
}, 3000)

onMounted(async () => {
    await getAllCampaigns()
})


const deleteCampaing = (id)=> {
    Swal.fire({
        title: 'Are You Sure!',
        text: 'you watnt to delete this?',
        icon: 'warning',
        confirmButtonColor: '#ddd',
        cancelButtonColor: 'red',
        confirmButtonText: 'Delete',
        showCancelButton: true,
    }).then((result) => {
        if (result.value) {
            sendRequest({
                url:`/api/delete-campaign/${id}`,
                method:"DELETE"
            })

            Toast.fire({
                icon: 'success',
                title: "Campaign Delete Successfully Done..."
            })
        }
    }).catch(() => {
        Swal.fire({
            icon: 'success',
            title: 'dont worry. your data is safe...'
        })
    })
}


</script>
