function getUserName() {
    var userName;
    $.ajax({
        type: 'GET',
        url: 'send_voice_message.php?a=getUserName',
        async: false,
        success: function (response) {
            userName = response;
        },
        error: function (error) {
            console.error('Error getting username:', error);
        }
    });
    return userName;
}
$(document).ready(function () {

    var recorder;
    var isRecording = false;

    $("#voice_message").click(function () {
        if (!isRecording) {
            startRecording();
        } else {
            stopRecording();
        }
    });

    function startRecording() {
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(function (stream) {
                recorder = new MediaRecorder(stream);
                recorder.start();
                isRecording = true;
                var hiddenDiv = document.getElementById('audio_message');
                hiddenDiv.style.display = 'block';
            })
            .catch(function (err) {
                console.error('Error accessing microphone:', err);
            });
    }

    function stopRecording() {
        isRecording = false;
        recorder.ondataavailable = function (e) {
            var blob = e.data;
            saveAudioFile(blob);
            var divToHide = document.getElementById('audio_message');
            if (divToHide) {
                divToHide.style.display = 'none';
            }
        };
        recorder.stop();
        setTimeout(() => {
            recorder.stream.getTracks().forEach(track => track.stop());
        }, 100); // Add a delay (adjust the time as needed)
        recorder.stream = null;
    }

    function saveAudioFile(blob) {
        var url = URL.createObjectURL(blob);
        var currentDate = new Date();
        var currentTime = currentDate.toISOString().replace(/:/g, '-').slice(0, -5);
        var filename = 'recording_' + currentTime + '.mp3';

        var formData = new FormData();
        formData.append('audioFile', blob, filename);

        $.ajax({
            type: 'POST',
            url: 'send_voice_message.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log('Audio file saved successfully:', response);
            },
            error: function (error) {
                console.error('Error saving audio file:', error);
            }
        });
    }

   
});
