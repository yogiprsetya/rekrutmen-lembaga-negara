<template>
    <b-container>
        <h1 class="text-center">Rekrutmen Bersama Lembaga Sipil Negara</h1>
        <b-form-group>
            <b-form-input v-model="smeSearch" placeholder="Cari Lembaga"></b-form-input>
        </b-form-group>

        <b-row>
            <b-col lg="3" v-for="listLN in filteredList" :key="listLN.id">
                <a :href="'/#/jobs/' + listLN.id">
                    <b-card :title="listLN.nama" img-top :img-src="listLN.logo" class="my-3 ln-deskripsi">
                        <b-card-text>
                            {{ listLN.deskripsi }}
                        </b-card-text>
                    </b-card>
                </a>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            dataLN: [],
            smeSearch: ''
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            axios.get(process.env.API_HOST + '/api/lembaga-view.php')
            .then(response => {
                this.dataLN = response.data
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
            return this.dataLN.filter(dataClass => {
                return dataClass.nama_lembaga.toLowerCase().includes(this.smeSearch.toLowerCase())
            })
        }
    }
}
</script>

<style>
.ln-deskripsi {
    text-decoration:none !important;
    color:#333 !important;
}

</style>
