<template>
    <b-container class="mb-5 p-5 card">
        <h4 class="row">
            <p class="col-sm-3">Posisi</p><p class="col-sm-7">: {{ jobDetail.nama_posisi }}</p>
            <p class="col-sm-2 mb-0 text-right">
                <b-button variant="primary" @click="apply()" v-b-modal.modals>Apply Job!</b-button>
            </p>
        </h4>

        <h4 class="row">
            <p class="col-sm-3">Lembaga Tujuan</p><p class="col-sm-9">: {{ jobDetail.nama_lembaga }}</p>
        </h4>

        <h4 class="row">
            <p class="col-sm-3">Tingkat Pendidikan</p><p class="col-sm-9">: {{ jobDetail.pendidikan }}</p>
        </h4>

        <h4 class="row">
            <p class="col-sm-12">Kualifikasi :</p>
        </h4>
        <div class="row">
            <p class="col-sm-12 card card-body bg-light" v-html="jobDetail.kualifikasi"></p>
        </div>

        <b-modal id="modals" hide-footer size="sm">
            <div class="text-center py-3">
                <h5>{{ resApply.message }}</h5>
            </div>
        </b-modal>

    </b-container>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            urlParams: window.location.href.split('/'),
            resApply: [],
            jobDetail: []
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/job-detail.php?id=' + this.urlParams[this.urlParams.length-1])
            .then(response => {
                this.jobDetail = response.data[0]
            })
            .catch(error =>  {
                console.log(error)
            })
        } else {
            window.location.assign('/#/login')
        }
    },
    methods: {
        apply() {
            let formData = new FormData();

            formData.append('nik', localStorage.tkn)
            formData.append('jobs', this.urlParams[this.urlParams.length-1])

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/apply.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                this.resApply = response.data
                //this.$root.$emit('bv::hide::modal', 'modals')
            })
            .catch(error => {
                console.log(response)
            })
        }
    }
}
</script>

<style>
.modal {top: 100px;}
</style>