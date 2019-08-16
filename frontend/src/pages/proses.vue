<template>
    <section class="container p-5 card">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h5 class="card-title">Proses rekrutment</h5>
            </div>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">Lembaga</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="list in dataJob" :key="list.id">
                        <td>{{ list.nama_lembaga }}</td>
                        <td>{{ list.nama_posisi }}</td>
                        <td><b-badge variant="primary">{{ list.status }}</b-badge></td>
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
            dataJob: [],
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/proses.php?nik=' + localStorage.tkn)
            .then(response => {
                this.dataJob = response.data
            })
            .catch(error =>  {
                console.log(error)
            })
        } else {
            window.location.assign('/#/login')
        }
    }
}
</script>
