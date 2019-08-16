<template>
    <b-container class="mb-5">
        <b-col md="9" offset-md="1" class="card p-5">
            <b-form>
                <b-form-group label="Foto Profil">
                    <b-form-file v-model="foto" accept=".png,.jpg,.jpeg" placeholder="Pas Foto. PNG / JPG / JPEG"></b-form-file>
                </b-form-group>

                <b-form-group label="NIK">
                    <b-form-input v-model="nik" type="text" placeholder="Nomor Induk Kependudukan"></b-form-input>
                </b-form-group>

                <b-form-group label="Nama">
                    <b-form-input v-model="nama" type="text" placeholder="Nama sesuai KTP"></b-form-input>
                </b-form-group>

                <b-form-group label="Email">
                    <b-form-input v-model="email" type="text" placeholder="Nama sesuai KTP"></b-form-input>
                </b-form-group>

                <b-form-group label="Jenis Kelamin">
                    <b-form-radio v-model="gender" value="Laki - laki">Laki - laki</b-form-radio>
                    <b-form-radio v-model="gender" value="Perempuan">Perempuan</b-form-radio>
                </b-form-group>

                <b-form-group label="Tempat Lahir">
                    <b-form-input v-model="tempat_lahir" type="text" required placeholder="Kab/Kota kelahiran"></b-form-input>
                </b-form-group>

                <b-form-group label="Tanggal Lahir">
                    <b-form-input v-model="tanggallahir" type="date" placeholder="Tanggal Lahir"></b-form-input>
                </b-form-group>

                <b-form-group label="Pendidikan Terakhir">
                    <b-form-radio v-model="pendidikan" value="SMA/K Sederajat">SMA/K Sederajat</b-form-radio>
                    <b-form-radio v-model="pendidikan" value="Diploma 3">Diploma 3</b-form-radio>
                    <b-form-radio v-model="pendidikan" value="S1/D4 Sederajat">S1/D4 Sederajat</b-form-radio>
                    <b-form-radio v-model="pendidikan" value="Magister">Magister</b-form-radio>
                    <b-form-radio v-model="pendidikan" value="Doktoral">Doktoral</b-form-radio>
                </b-form-group>

                <b-form-group label="Daftar Riwayat Hidup">
                    <b-form-file v-model="file_cv" accept=".pdf" placeholder="CV terbaru dan menarik. Dalam format PDF"></b-form-file>
                </b-form-group>

                <b-button type="submit" variant="primary" @click="update()">Simpan</b-button>
            </b-form>
        </b-col>
    </b-container>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            foto: '',
            nik: '',
            nama: '',
            email: '',
            gender: '',
            tempat_lahir: '',
            tanggallahir: '',
            pendidikan: '',
            file_cv: ''
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/data-diri.php?nik=' + localStorage.tkn)
            .then(response => {
                this.foto = response.data[0].foto
                this.nik = response.data[0].nik
                this.nama = response.data[0].nama
                this.email = response.data[0].email
                this.gender = response.data[0].gender
                this.tempat_lahir = response.data[0].tempat_lahir
                this.tanggallahir = response.data[0].tanggallahir
                this.pendidikan = response.data[0].pendidikan
                this.file_cv = response.data[0].file_cv
            })
            .catch(error =>  {
                console.log(error)
            })
        } else {
            window.location.assign('/#/login')
        }
    },
    methods: {
        update() {
            let formData = new FormData();

            formData.append('foto', this.foto)
            formData.append('nik', this.nik)
            formData.append('nama', this.nama)
            formData.append('email', this.email)
            formData.append('gender', this.gender)
            formData.append('tempat_lahir', this.tempat_lahir)
            formData.append('tanggallahir', this.tanggallahir)
            formData.append('pendidikan', this.pendidikan)
            formData.append('file_cv', this.file_cv)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/edit-profil.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                window.location.assign("#/data-diri")
            })
            .catch(response => {
                console.log(response)
            })
        }
    }
}
</script>

<style>
</style>
