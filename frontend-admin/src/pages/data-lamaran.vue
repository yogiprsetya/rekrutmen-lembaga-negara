<template>
    <section class="container p-5 card">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h5 class="card-title">Lamaran Masuk</h5>
            </div>
            <div class="col-lg-4 input-group">
                <input class="form-control mr-2" v-model="smeSearch" type="text" placeholder="Search..">
            </div>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">Lembaga</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(job) in filteredList" :key="job.id" @click="selectJobs(job.id)">
                        <td>{{ job.nama_lembaga }}</td>
                        <td>{{ job.nama_posisi }}</td>
                        <td>{{ job.nama }}</td>
                        <td><b-badge variant="primary">{{ job.status }}</b-badge></td>
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
            dataLamaran: [],
            smeSearch: ''
        }
    },
    methods: {
        selectJobs(cId) {
            return window.location.assign('#/data-pelamar/' + cId)
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/data-apply.php')
            .then(response => {
                this.dataLamaran = response.data
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
            return this.dataLamaran.filter(apply => {
                return apply.nama.toLowerCase().includes(this.smeSearch.toLowerCase())
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
