@extends('layouts.app')

@section('content')
    <h1> Photo </h1>

    <div id="divPhoto">
        Тут будут фотографии
    </div>

    <div>
        <form  id="frmCreatePhoto">
            <h3> Create photo</h3>
            <input type="text" name="name">
            <input type="submit">
        </form>
    </div>

    <div id="divErrMessage">

    </div>

    <script>

        const divErrMessage = document.getElementById("divErrMessage")
        function echoError(err) {
            divErrMessage.innerHTML = '<div class="alert alert-danger" role="alert">' + err.message + '</div>'
        }

        function clearError() {
            divErrMessage.innerHTML = ''
        }


        const frmCreatePhoto = document.getElementById("frmCreatePhoto")
        frmCreatePhoto.onsubmit = (ev) => {
            ev.preventDefault()
            let data = new FormData(frmCreatePhoto)
            clearError()

            fetch('/api/photo', {
                method: 'POST',
                body: data
            })
                .then(res => {
                    console.log (res.status)
                    if (res.status === 201) {
                        frmCreatePhoto.reset()
                        loadAllPhoto()
                    }
                    else
                        throw { message: "Error"}
                })
                .catch(err => {
                    console.error(err)
                    echoError(err)
                })
        }
    </script>


    <script>

        const divPhoto = document.getElementById("divPhoto")

        /**
         * ОБработка события удаления
         * @param ev
         */
        function deletePhoto(ev) {
            ev.preventDefault()
            const id = ev.target.parentNode.id
            console.log("try del: " + id)

            fetch('/api/photo/' + id, {
                method: 'DELETE'
            })
                .then(res => {
                    console.log (res.status)
                    if (res.status === 204) {
                        frmCreatePhoto.reset()
                        loadAllPhoto()
                    }
                    else
                        throw { message: "Error"}
                })
                .catch(err => {
                    console.error(err)
                    echoError(err)
                })

        }

        /**
         * Построить фотогалерею
         * @param photos
         */
        function buildAll(photos) {
            let ul = document.createElement("ul")
            photos.map( photo => {
                let li = document.createElement("li")
                li.id = photo.id
                li.innerText = photo.name

                let spanCategory = document.createElement("span")
                spanCategory.innerHTML = photo.category.name
                li.appendChild(spanCategory)

                let spanDel = document.createElement("span")
                spanDel.innerHTML = ' - '
                spanDel.onclick = deletePhoto
                li.appendChild(spanDel)
                ul.appendChild(li)
            })

            divPhoto.innerHTML = ''
            divPhoto.appendChild(ul)
        }

        /**
         * Получить данные для фотогалереи
         */
        function loadAllPhoto() {
            fetch('/api/photo')
                .then(res => res.json())
                .then(photos => {
                    console.log(photos)
                    buildAll(photos)
                })
                .catch( err => {
                    console.error(err)
                    alert(err.message)
                })
        }
        loadAllPhoto()
    </script>


    <script>

        // function jq_buildAll(photos) {
        //     let lis = '';
        //     photos.map( photo => {
        //         lis+= '<li>' + photo.name + '</li>'
        //     })
        //     console.log(lis)
        //     $('#divPhoto').append( '<ul>' + lis + '</ul>')
        // }
        //
        // function jq_loadAllPhoto() {
        //     console.log('onLoad')
        //     $.get( '/api/photo', function( photos ) {
        //         console.log(photos)
        //         jq_buildAll(photos)
        //     });
        // }
        // document.addEventListener("DOMContentLoaded", jq_loadAllPhoto);

    </script>

@endsection
