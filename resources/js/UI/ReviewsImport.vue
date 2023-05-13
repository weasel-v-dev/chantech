<template>
    <div>
        <v-file-input
            accept="csv/*"
            label="File input"
            v-model="file"
        ></v-file-input>
        <v-progress-linear
            v-if="importing"
            indeterminate
            color="cyan"
            purple
            rounded
        ></v-progress-linear>
        <v-btn
            v-else
            elevation="2"
            dark
            x-large
            color="cyan"
            block
            @click.once="send"
            :disabled="readyArr.length === 0"
        >
            IMPORT
        </v-btn>
        <v-snackbar
            :timeout="3000"
            v-for="error in errors"
            :value="errors.length"
            :key="error.id"
            fixed
            bottom
            color="red accent-2"
            outlined
            right
        >
            {{ error.message}}
        </v-snackbar>
        <v-snackbar
            :timeout="3000"
            :value="success.length"
            fixed
            bottom
            right
            tile
            color="success"
            v-for="item in success"
            :key="item.id"
        >
            {{ item.message }}
        </v-snackbar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            file: [],
            errors: [],
            success: [],
            readyArr: [],
            importing: false,
        }
    },
    watch: {
        file() {
            const promise = new Promise((resolve, reject) => {
                const reader = new FileReader();
                const vm = this;
                reader.onload = e => {
                    resolve((vm.fileinput = reader.result));
                };
                reader.readAsText(this.file);
            });
            promise.then(
                result => {
                    const lines = result.split('\n')
                    const header = lines[0].split(',')
                    const output = lines.slice(1).map(line => {
                        const fields = line.replace(/"/g, '').split(',')
                        const json = Object.fromEntries(header.map((h, i) => [this.cleanNamesColumns(h), fields[i]]));
                        json.reviewer = json.reviewer ?? '';
                        json.email = json.email ?? '';
                        json.review = json.review ?? '';
                        json.rating = json.rating ?? '';
                        json.employee = json.employee ?? '';
                        return json;
                    });
                    this.errors = this.validColumn(output[0]);
                    if(this.errors.length) {
                        this.readyArr = [];
                    }else {
                        this.readyArr = output;
                    }
                },
                error => {
                    // console.log(error);
                    this.readyArr = [];
                }
            );
        }
    },
    methods: {
        cleanNamesColumns(columns) {
            return columns.replace(/\s+/, '_').replace(/"/g, '').toLowerCase()
        },
        validColumn(fistRow) {
            let res = [];
            const importantFields = ['reviewer', 'email', 'review', 'rating', 'employee', 'employees_position', 'unique_employee_number', 'company', 'company_description'];
            for(const nameColumn in key => fistRow){
                let findField = '';
                importantFields.forEach((importantField) => {
                    if(importantField === nameColumn) {
                        findField = importantField;
                        return false;
                    }
                })
                if(findField === '') {
                    res.push({
                        id: key,
                        message: nameColumn + ' is the wrong field'
                    });
                }
            }
            return res;
        },
        send() {
            console.log('readyArr', this.readyArr)
            this.importing = true;

            axios.post('distribution', {
                data: this.readyArr
            }, {
                'Content-Type': 'application/json'
            }).then((res) => {
                console.log(res.data);
                this.file = [];
                this.readyArr = [];
                this.importing = false;
                this.success = res.data.message
            }).catch((res) => {
                console.log(res)
                this.file = [];
                this.readyArr = [];
                this.importing = false;
            })
        }
    }
}
</script>
<style scoped>

</style>
