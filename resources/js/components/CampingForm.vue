<template>
    <div class="form-container flex flex-col centering space-around">
        <h2 class="main-text-color">{{action == 'edit' ? 'Update Camping' : 'Add New Camping'}}</h2>
        <form class="mb-20" action="POST" @submit.prevent="add()" enctype="multipart/form-data">
            <div class="form-wrapper flex mt-20">
                <div class="form-chunk flex flex-col vertical-align">
                    <div class="form-element flex flex-col relative">
                        <span class="w-100 main-text-color">Camping Name:</span>
                        <input v-bind:class="{ danger : errors.name }"  type="text" v-model="camping.name" name="name" placeholder="Camping name">
                        <span class="error-span absolute text-danger" v-if="errors.name">{{errors.name.toString()}}</span>
                    </div>
                    <div class="form-element flex flex-col relative">
                        <span class="w-100 main-text-color">Country:</span>
                        <input v-bind:class="{ danger : errors.country }" type="text" name="country" v-model="camping.country" placeholder="Country">
                        <span class="error-span absolute text-danger" v-if="errors.country">{{errors.country.toString()}}</span>
                    </div>
                    <div class="form-element flex flex-col relative">
                        <span class="w-100 main-text-color">City:</span>
                        <input v-bind:class="{ danger : errors.city }" type="text" name="city" v-model="camping.city" placeholder="City">
                        <span class="error-span absolute text-danger" v-if="errors.city">{{errors.city.toString()}}</span>
                    </div>
                    <div class="form-element flex flex-col relative">
                        <span class="w-100 main-text-color">Website:</span>
                        <input v-bind:class="{ danger : errors.website }" type="text" name="website" v-model="camping.website" placeholder="Website">
                        <span class="error-span absolute text-danger" v-if="errors.website">{{errors.website.toString()}}</span>
                    </div>
                    <div class="form-element flex flex-col relative">
                        <span class="w-100 main-text-color">Rating:</span>
                        <input v-bind:class="{ danger : errors.rating }" type="text" name="rating" v-model="camping.rating" placeholder="Rating">
                        <span class="error-span absolute text-danger" v-if="errors.rating">{{errors.rating.toString()}}</span>
                    </div>
                </div>
                <div class="form-chunk flex flex-col vertical-align">
                    <div class="form-element flex flex-col relative">
                        <span class="w-100 main-text-color">Tags:</span>
                        <select v-model="campingTags" name="tags" multiple>
                            <option 
                                v-for="tag in allTags" :key="tag.id" 
                                v-bind:value="tag.id"
                                :selected="campingTags.includes(tag.id)">
                                {{tag.name}}
                            </option>
                        </select>
                    </div>
                    <div v-if="action === 'add'" class="form-element flex flex-col relative">
                        <span class="w-100 main-text-color">Upload images:&nbsp;<i class="far fa-images upload-cover"></i></span>
                        <label class="btn img-upload-input mt-20">
                            Choose file/s
                            <input v-on:change="onChange" type="file" accept="image/*" multiple>
                        </label>
                    </div>
                    <span v-if="maxImgError" class="error-span text-danger">{{maxImgError}}</span>
                    <div v-if="images.length > 0" class="form-element">
                        <span class="main-text-color">Images to upload:</span>
                        <div v-for="image in images" :key="image.name">
                            {{image.name}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <button v-if="action == 'add'" @click="add()" class="form-submit-btn">Create</button>
        <button v-if="action == 'edit'" @click="update()" class="form-submit-btn">Update</button>
    </div>
</template>
<script>

export default {
    props: ['camp', 'tags', 'action', 'method'],
    data: function () {
        return {
            camping: {
                name: '',
                country: '',
                city: '',
                website:  '',
                rating: '',
                review: ''
            },
            campId: '',
            campingTags: [],
            allTags: [],
            errors: [],
            images: [],
            maxImageCount: 5,
            maxImgError: ''
        }
    },
    methods: {
        add() {
            const formData = new FormData();
            const fields = ["name", "country", "city", "website", "rating", "review"];
            let data = Object.values(this.camping);

            for (let i=0; i< data.length; i++) {
                if (this.images[i]) {
                    formData.set('image' + i, this.images[i])
                }
                formData.set(fields[i], data[i]);
            }
            formData.set('tags', JSON.stringify(this.campingTags));

            axios.post('/admin/add', formData)
            .then(response => {
                if (response.status === 201) {
                    window.location.replace('/admin/all')
                }
            })
            .catch(e => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors
                }
            })
        },
        update() {
            axios.put('/admin/' + this.campId + '/update', {
                name: this.camping.name,
                country: this.camping.country,
                city: this.camping.city,
                website: this.camping.website,
                review: this.camping.review,
                rating: this.camping.rating,
                tags: this.campingTags
            })
            .then(response => {
                if (response.status === 200) {
                    window.location.replace('/admin/' + this.method);
                }
            })
            .catch(e => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors;
                }
            })
        },
        fetchTags() {
            axios.get('/tags/all')
            .then (response => {
                if (response.status === 200) {
                    this.allTags = response.data
                }
            })
            .catch(error => {
                console.log(error);

            })
        },
        fillEditableData () {
            if (this.action == 'edit') {
                this.campId = this.camp.id,
                this.camping.name = this.camp.name,
                this.camping.country = this.camp.country,
                this.camping.city = this.camp.city,
                this.camping.website = this.camp.website,
                this.camping.rating = this.camp.rating,
                this.campingTags = this.tags
            }
        },
        onChange(e) {
            if(e.target.files.length > this.maxImageCount) {
                e.preventDefault();
                this.maxImgError = "Maximum 5 files are available for uploading";
                return;
            }
            this.images = e.target.files;
        },
    },
    created() {
      this.fetchTags();
      this.fillEditableData();
      axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem('access_token');
    }
};
</script>