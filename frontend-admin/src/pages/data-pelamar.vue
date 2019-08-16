<template>
    <b-container class="my-5">
        <b-row>
            <b-col md="10" class="card px-4 py-2 mb-3 d-inline">
                Data pelamar pada <b>{{dataDiri.nama_lembaga}}</b> untuk posisi <b>{{dataDiri.nama_posisi}}</b>.
            </b-col>
            <b-col md="2" class="p-0 text-right">
                <b-button variant="warning" v-b-modal.appr>Approve</b-button>
            </b-col>
            <b-col md="3" class="pl-0">
                <div class="foto mb-2">
                    <b-img :src="dataDiri.foto"></b-img>
                </div>
            </b-col>
            <b-col md="9" class="card p-4 profile">
                <b-row>
                    <b-col md="3">NIK</b-col><b-col md="9">: {{ dataDiri.nik }}</b-col>
                    <b-col md="3">Nama Lengkap</b-col><b-col md="9">: {{ dataDiri.nama }}</b-col>
                    <b-col md="3">Alamat Email</b-col><b-col md="9">: {{ dataDiri.email }}</b-col>
                    <b-col md="3">Jenis Kelamin</b-col><b-col md="9">: {{ dataDiri.gender }}</b-col>
                    <b-col md="3">Tempat Lahir</b-col><b-col md="9">: {{ dataDiri.tempat_lahir }}</b-col>
                    <b-col md="3">Tanggal Lahir</b-col><b-col md="9">: {{ dataDiri.tanggallahir }}</b-col>
                    <b-col md="3">Pendidikan</b-col><b-col md="9">: {{ dataDiri.pendidikan }}</b-col>
                    <b-col md="12">Resume</b-col>
                    <b-col md="12">
                        <a :href="dataDiri.file_cv">
                            <iframe :src="dataDiri.file_cv" width="100%" height="100%"></iframe>
                        </a>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>

        <b-modal id="appr" hide-footer title="Status Apply">
            <b-form-radio-group v-model="status" :options="options" buttons button-variant="outline-success"></b-form-radio-group>
            <div class="float-right d-block">
                <b-button variant="primary" @click="updateProses()">SAVE</b-button>
            </div>
        </b-modal>

    </b-container>
</template>

<script>
import axios from 'axios'
import pdf from 'vue-pdf'

export default {
    components: {
        pdf
    },
    data () {
        return {
            urlParams: window.location.href.split('/'),
            dataDiri: [],
            status: '',
            options: [{text: 'Interview', value: 'Interview'},{text: 'Gugur', value: 'Gugur'},{text: 'Seleksi', value: 'Seleksi'}]
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/data-pelamar.php?id=' + this.urlParams[this.urlParams.length-1])
            .then(response => {
                this.dataDiri = response.data[0]
                this.status = this.dataDiri.status 
            })
            .catch(error =>  {
                console.log(error)
            })
        } else {
            window.location.assign('/#/login')
        }
    },
    methods: {
        updateProses(){
            let formData = new FormData();

            formData.append('status', this.status)
            formData.append('id', this.urlParams[this.urlParams.length-1])

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/update-proses.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                this.$root.$emit('bv::hide::modal', 'appr')
            })
            .catch(response => {
                console.log(response)
            })
        }
    }
}
</script>


<style>
.foto img {
    max-width: 100%;
}
.profile {
    font-size: 18px;
    line-height: 33px
}
.pdf-button img {
    width: 100px
}
iframe {
    height: 1150px;
}
</style>
