@extends('guru.no_sidebar')
@section('content')
    <div class="mx-auto w-3/4">
        <div class="shadow-box mt-32 mb-4 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
            <h1 class="text-2xl mt-2 font-bold text-blue-normal-19 font-[Montserrat]">Absen Masuk Kelas</h1>
            <div id="card_cam" class="relative">
                <video id="videoInput" width="700" height="500" muted controls class="mx-auto mt-4"></video>
            </div>
            <div class="button flex justify-center">
                <button class="px-12 py-3 bg-bg-blue-dark rounded-xl text-white font-bold mt-8 flex mx-auto mb-2 cursor-pointer" onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}'">Kembali</button>
            </div>
        </div>
        {{-- autoplay loop playsinline --}}
    </div>

    <script src="{{ asset('cam_js/js/face-api.min.js') }}"></script>

    <script>
        const video = document.getElementById('videoInput')
        const divSpesial = document.getElementById('card_cam')
        // document.getElementById("card_cam").innerHTML = "<center><h1>Mohon Tunggu...</h1></center>"
        Promise.all([
            faceapi.nets.faceRecognitionNet.loadFromUri("{{ asset('cam_js/models') }}"),
            faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('cam_js/models') }}"),
            faceapi.nets.ssdMobilenetv1.loadFromUri("{{ asset('cam_js/models') }}")
        ]).then(start)
        
        function start() {
            console.log('Models Loaded')

            navigator.getUserMedia({
                    video: {}
                },
                stream => video.srcObject = stream,
                err => console.error(err)
            )

            console.log('video added')
            recognizeFaces()
        }

        async function recognizeFaces() {
            const labeledDescriptors = await loadLabeledImages()
            console.log(labeledDescriptors)
            const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.7)

            video.addEventListener('play', async () => {
                console.log('Playing')
                const canvas = faceapi.createCanvasFromMedia(video)

                document.body.append(canvas)

                const displaySize = {
                    width: video.width,
                    height: video.height
                }
                faceapi.matchDimensions(canvas, displaySize)

                setInterval(async () => {
                    const detections = await faceapi.detectAllFaces(video).withFaceLandmarks()
                        .withFaceDescriptors()

                    const resizedDetections = faceapi.resizeResults(detections, displaySize)

                    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

                    const results = resizedDetections.map((d) => {
                        return faceMatcher.findBestMatch(d.descriptor)
                    })
                    results.forEach((result, i) => {
                        const box = resizedDetections[i].detection.box
                        const drawBox = new faceapi.draw.DrawBox(box, {
                            label: result.toString()
                        })
                        drawBox.draw(canvas)
                    })
                }, 100)



            })
        }

        function loadLabeledImages() {
            const labels = ['Nana']
            return Promise.all(
                labels.map(async (label) => {
                    const descriptions = []
                    for (let i = 1; i <= 2; i++) {
                        const img = await faceapi.fetchImage("{{ asset('cam_js/images') }}"+`/${label}.${i}.jpg`)
                        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks()
                            .withFaceDescriptor()
                        // console.log(label + i + JSON.stringify(detections))
                        descriptions.push(detections.descriptor)
                    }
                    console.log(label + '| Faces Loaded ')
                    return new faceapi.LabeledFaceDescriptors(label, descriptions)
                })
            )
        }
    </script>
@endsection