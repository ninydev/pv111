import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useFakeImageStore = defineStore('fakeImage', {


    state: () => ({
    }),


    actions: {
        doStartProcess() {
            const formData = new FormData();
            formData.append('name', 'Photo Name');

            fetch('/api/fake_image', {
                method: 'POST',
                body: formData
            })
                .then(res => {
                    if (res.status !== 201) {
                        throw new Object({
                            message: "Error create new fake image"
                        })
                    }
                    return res.json()
                })
                .then(fakeImage => {
                    console.log("Image Create")
                    console.log(fakeImage)
                })
                .catch( err => {
                    console.log("Error Create Image")
                    console.log(err)
                })

        }
    }
});
