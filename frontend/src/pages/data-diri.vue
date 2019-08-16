<template>
    <b-container class="mb-5">
        <b-row>
            <b-col md="3">
                <div class="foto mb-2">
                    <b-img :src="dataDiri.foto"></b-img>
                </div>
                <b-button variant="warning" href="#/edit-profil">Edit Profil</b-button>
            </b-col>
            <b-col md="8" class="card p-4 profile">
                <b-row>
                    <b-col md="3">NIK</b-col><b-col md="9">: {{ dataDiri.nik }}</b-col>
                    <b-col md="3">Nama Lengkap</b-col><b-col md="9">: {{ dataDiri.nama }}</b-col>
                    <b-col md="3">Alamat Email</b-col><b-col md="9">: {{ dataDiri.email }}</b-col>
                    <b-col md="3">Jenis Kelamin</b-col><b-col md="9">: {{ dataDiri.gender }}</b-col>
                    <b-col md="3">Tempat Lahir</b-col><b-col md="9">: {{ dataDiri.tempat_lahir }}</b-col>
                    <b-col md="3">Tanggal Lahir</b-col><b-col md="9">: {{ dataDiri.tanggallahir }}</b-col>
                    <b-col md="3">Pendidikan</b-col><b-col md="9">: {{ dataDiri.pendidikan }}</b-col>
                    <b-col md="12">Resume</b-col><b-col md="12" class="align-top">
                        
                    <iframe :src="dataDiri.file_cv"></iframe>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>
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
            dataDiri: []
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/data-diri.php?nik=' + localStorage.tkn)
            .then(response => {
                this.dataDiri = response.data[0]
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
    height: 1000px;
    width: 100%;
}
</style>
