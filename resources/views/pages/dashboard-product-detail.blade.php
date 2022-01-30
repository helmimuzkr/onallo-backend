@extends('layouts.dashboard')

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
 <div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Kaos Polos</h2>
    <p class="dashboard-subtitle">Product Details</p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-12 mb-4">
        <button type="submit" class="btn btn-dark mr-2">
          Update Product
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <form action="">
          <div class="card">
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      aria-describedby="name"
                      name="storeName"
                      value="Nike"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input
                      type="number"
                      class="form-control"
                      id="email"
                      aria-describedby="price"
                      name="price"
                      value="2000000"
                    />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select
                      class="form-control"
                      name="category"
                      id="category"
                    >
                      <option value="" disabled>
                        Select Category
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <div id="editor" name="description"></div>
                    <div
                      id="word-count"
                      name="word-count"
                      class="word-count"
                    ></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="update-photo"
                          >Update Photos</label
                        >
                      </div>
                      <div class="col-4">
                        <div class="gallery-container">
                          <img
                            src="/images/dashboard-product-card.png"
                            alt=""
                            class="w-100"
                          />
                          <a href="#" class="delete-gallery">
                            <img
                              src="/images/icon-remove.svg"
                              alt=""
                            />
                          </a>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="gallery-container">
                          <img
                            src="/images/dashboard-product-card.png"
                            alt=""
                            class="w-100"
                          />
                          <a href="#" class="delete-gallery">
                            <img
                              src="/images/icon-remove.svg"
                              alt=""
                            />
                          </a>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="gallery-container">
                          <img
                            src="/images/dashboard-product-card.png"
                            alt=""
                            class="w-100"
                          />
                          <a href="#" class="delete-gallery">
                            <img
                              src="/images/icon-remove.svg"
                              alt=""
                            />
                          </a>
                        </div>
                      </div>
                      <div class="col mt-3">
                        <input
                          type="file"
                          id="file"
                          style="display: none"
                          multiple
                        />
                        <button
                          type="button"
                          class="btn btn-secondary btn-block py-2 px-5"
                          onclick="thisFileUpload()"
                        >
                          Add Photo
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
 </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor.create(document.querySelector("#editor"), {
        wordCount: {
        onUpdate: (stats) => {
            doSthWithWordNumber(stats.words);
            doSthWithCharacterNumber(stats.characters);

            console.log(
            `Characters: ${stats.characters}\nWords: ${stats.words}`
            );
        },
        },
    })
        .then((editor) => {
        const wordCountPlugin = editor.plugins.get("WordCount");
        const wordCountWrapper = document.getElementById("word-count");

        wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);
        })
        .catch((error) => {
        console.error(error);
        });
    </script>
    <script>
    function thisFileUpload() {
        document.getElementById("file").click();
    }
    </script>
@endpush