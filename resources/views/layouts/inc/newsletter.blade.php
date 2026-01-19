<!-- Newsletter Start -->
<div class="container newsletter mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 border rounded p-1">
            <div class="border rounded text-center p-1">
                <div class="bg-white rounded text-center p-5">
                    <h4 class="mb-4">
                        Subscribe Our
                        <span class="text-primary text-uppercase">Newsletter</span>
                    </h4>

                    <form id="newsletterForm">
                        @csrf
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control w-100 py-3 ps-4 pe-5" type="email" name="email"
                                placeholder="Enter your email" required>
                            <button type="submit"
                                class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">
                                Submit
                            </button>
                        </div>
                    </form>

                    <p id="newsletterMsg" class="mt-3"></p>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->