const ComputerVisionClient =
    require("@azure/cognitiveservices-computervision").ComputerVisionClient;
const ApiKeyCredentials = require("@azure/ms-rest-js").ApiKeyCredentials;

const KEY = "6b";
const ENDPOINT = "azure.com";

const computerVisionClient = new ComputerVisionClient(
    new ApiKeyCredentials({ inHeader: { "Ocp-Apim-Subscription-Key": KEY } }),
    ENDPOINT
);

// Изобржение я беру из своего хранилища (куда она попадает из например соседнего микросервиса)
const descUrl = "https://itsteppv111.blob.core.windows.net/avatars/Lab325.jpg";



    computerVisionClient.describeImage(descUrl)
        .then(res => {
            console.log(res);
        })
        .catch(err => {
            console.error(err);
        });


