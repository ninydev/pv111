
const uploadFileToBlobStorage = require('./../helpers/azureStorage')

module.exports = function (request, response) {

    if (request.files.avatar) {
        console.debug(request.files.avatar);
        const avatarFile = request.files.avatar;
        const objectName = avatarFile.name;

        uploadFileToBlobStorage('avatars', objectName, avatarFile.data)
            .then(() =>{
                return response.status(200).json({
                    message: "File " + objectName + " upload"
                })
            })
            .catch((err) => {
                return response.status(419).json({
                    message: err.message
                })
            });


    } else {
        return response.status(419).json({
            message: 'File not Found'
        })
    }
}