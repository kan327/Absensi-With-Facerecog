@extends('guru.no_sidebar')
@section('content')
    <input type="hidden" id="data_siswa" value="{{ $data_siswa }}">
    <div class="mx-auto w-3/4">
        <div
            class="shadow-box mt-32 mb-4 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
            <h1 class="text-2xl mt-2 font-bold text-blue-normal-19 font-[Montserrat]">Absen Masuk | {{ $data_kelas->kelas }}
            </h1>
            <div id="card_cam" class="relative">

                <div id="loading" class="absolute w-full h-[100%] bg-white z-10 flex flex-col">
                    <div class="left-1/2 top-1/2 absolute items-center" style="transform: translate(-50%, -50%);">
                        <img class="mx-auto" src="{{ asset('assets/img/progress.gif') }}" alt="">
                        <p class="font-semibold text-placeholder">Mohon Tunggu Sebentar</p>
                    </div>
                </div>

                <video id="videoInput" width="700" height="500" muted autoplay loop playsinline
                    class="mx-auto mt-4"></video>

                {{-- result --}}
                <div id="text_result" class="mt-[3%]">

                </div>

            </div>
            <div class="button flex justify-center">
                <button
                    class="px-[20%] py-2 cursor-pointer bg-white hover:bg-bg-blue-dark text-bg-blue-dark hover:text-white border border-bg-blue-dark rounded-md font-bold mt-8 flex mx-auto mb-2"
                    onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}'">Kembali</button>
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


            navigator.getUserMedia({
                    video: {}
                },
                stream => video.srcObject = stream,
                err => console.error(err)
            )


            recognizeFaces()

        }

        var labels = {{ Js::from($data_siswa->pluck('nama_siswa')) }} //['Ridho']

        async function recognizeFaces() {
            const labeledDescriptors = await loadLabeledImages()
            // console.log(labeledDescriptors)
            const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.5)
            console.log(faceMatcher)
            document.getElementById("loading").style.display = "none"
            document.getElementById("loading").style.marginTop = "176px"
            video.addEventListener('click', async () => {
                console.log('Playing')
                const canvas = faceapi.createCanvasFromMedia(video)

                document.body.append(canvas)

                const displaySize = {
                    width: video.width,
                    height: video.height
                }
                faceapi.matchDimensions(canvas, displaySize)
                var no = 0

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

                    // simpan !!!!!!!!
                    console.log(results)

                    results.forEach(result => {
                        labels.forEach(nama => {
                            if (result._label === nama) {
                                $.ajax({
                                    type: "GET",
                                    url: "cam_absen_masuk/" + result
                                        ._label,
                                    success: function(ress) {
                                        $("#text_result").html(ress)
                                    }
                                });
                            }
                        })
                    })


                }, 100)



            })
        }
        // 

        function loadLabeledImages() {
            var data_siswa = document.getElementById("data_siswa")


            // console.log(labels.replace("&quot;", '"'))
            console.log(labels)
            return Promise.all(
                labels.map(async (label) => {
                    const descriptions = []
                    for (let i = 1; i <= 15; i++) {
                        const img = await faceapi.fetchImage("{{ asset('storage/cam_js/images') }}" +
                            `/${label}.${i}.jpg`)
                        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks()
                            .withFaceDescriptor()
                        descriptions.push(detections.descriptor)
                        // console.log(descriptions)

                    }
                    console.log(label + '| Faces Loaded ')
                    return new faceapi.LabeledFaceDescriptors(label, descriptions)
                })
            )

        }
    </script>
@endsection
