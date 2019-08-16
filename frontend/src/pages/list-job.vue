<template>
    <section class="container p-5 card">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h5 class="card-title">Ketersediaan kesempatan kerja <b>{{ namaLembaga }}</b></h5>
            </div>
            <div class="col-lg-4 input-group">
                <input class="form-control mr-2" v-model="smeSearch" type="text" placeholder="Search..">
            </div>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">Posisi</th>
                        <th scope="col">Pendidikan</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(job) in filteredList" :key="job.id" @click="selectJobs(job.id)">
                        <td>{{ job.nama_posisi }}</td>
                        <td>{{ job.pendidikan }}</td>
                        <td>{{ job.jumlah }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            urlParams: window.location.href.split('/'),
            dataJob: [],
            namaLembaga: '',
            smeSearch: ''
        }
    },
    methods: {
        selectJobs(cId) {
            return window.location.assign('#/job-detail/' + cId)
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/job-view.php?lembaga=' + this.urlParams[this.urlParams.length-1])
            .then(response => {
                this.dataJob = response.data
                this.namaLembaga = response.data[0].nama_lembaga
            })
            .catch(error =>  {
                console.log(error)
            })
        } else {
            window.location.assign('/#/login')
        }
    },
    computed: {
        filteredList() {
            return this.dataJob.filter(dataClass => {
                return dataClass.nama_posisi.toLowerCase().includes(this.smeSearch.toLowerCase())
            })
        }
    }
}
</script>

<style>
table tbody tr {
    cursor: pointer;
}
</style>
