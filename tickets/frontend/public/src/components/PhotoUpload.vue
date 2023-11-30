<template>
  <div>
    <input type="button" value="Send" @click="send">
    <input type="button" value="x" @click="clear">
    <input type="file" @change="handleFileChange" accept="image/*">
    <cropper
        class="cropper"
        :src="imageBody"
        :stencil-props="{aspectRatio: 10/12}"
        @change="handleCropperChange"
        ref="cropperRef"
        v-if="imageBody"
    />

    <img :src="imageFromCanvas" v-if="imageBody">
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Cropper } from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';


const imageBody = ref(null);
const imageFromCanvas = ref(null);
const cropperRef = ref(null);


const handleCropperChange = () => {
  const { canvas } = cropperRef.value.getResult();
  imageFromCanvas.value = canvas.toDataURL();
}

const  dataURItoBlob = (dataURI) => {
  // convert base64 to raw binary data held in a string
  // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
  let byteString = atob(dataURI.split(',')[1]);

  // separate out the mime component
  let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

  // write the bytes of the string to an ArrayBuffer
  let ab = new ArrayBuffer(byteString.length);

  // create a view into the buffer
  let ia = new Uint8Array(ab);

  // set the bytes of the buffer to the correct values
  for (let i = 0; i < byteString.length; i++) {
    ia[i] = byteString.charCodeAt(i);
  }

  // write the ArrayBuffer to a blob, and you're done
  return new Blob([ab], {type: mimeString});
}

const send = () => {
  console.log("send Image")


  // Создаем объект FormData
  const formData = new FormData();
  // Добавляем данные изображения в объект FormData
  formData.append('photo', dataURItoBlob(imageFromCanvas.value));
  formData.append('name', 'Photo Name');

  fetch('/api/tickets', {
    method: 'POST',
    body: formData
  })
      .then(res => {
        console.log (res);
      })
      .catch( err => {
        console.log(err)
      })



}

const handleFileChange = (event) => {
  const file = event.target.files[0];
  const reader = new FileReader();

  reader.onload = (e) => {
    imageBody.value = e.target.result;
  };

  reader.readAsDataURL(file);
};

const clear = () => {
  imageBody.value = null;
  imageFromCanvas.value = null;
}
</script>
