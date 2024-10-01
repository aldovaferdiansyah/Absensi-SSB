    const proofType = document.getElementById('proofType');
    const cameraSection = document.getElementById('cameraSection');
    const fileSection = document.getElementById('fileSection');

    const startCameraButton = document.getElementById('startCamera');
    const video = document.getElementById('camera');
    const canvas = document.getElementById('canvas');
    const capturedImage = document.getElementById('capturedImage');
    const proofData = document.getElementById('proofData');
    const captureButton = document.getElementById('capture');

    // Switch between camera and file input based on selection
    proofType.addEventListener('change', () => {
        if (proofType.value === 'camera') {
            cameraSection.style.display = 'block';
            fileSection.style.display = 'none';
        } else {
            cameraSection.style.display = 'none';
            fileSection.style.display = 'block';
        }
    });

    // Camera functionality
    startCameraButton.addEventListener('click', () => {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
                video.style.display = 'block';
                captureButton.style.display = 'inline-block';
                startCameraButton.style.display = 'none';
            })
            .catch(err => {
                console.error("Error accessing the camera: ", err);
            });
    });

    captureButton.addEventListener('click', () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imageData = canvas.toDataURL('image/png');
        capturedImage.src = imageData;
        capturedImage.style.display = 'block';
        proofData.value = imageData;
    });