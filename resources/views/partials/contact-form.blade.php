  <section class="py-5 support-section">
      <div class="py-5 support-bg">
          <div class="text-center query-title">
              <h2 class="text-uppercase">{{ __($title ?? 'Need any Queries') }} </h2>
              <P>
                  @lang('If you need any queries about us or our business services, please feel free to message us')
              </P>
          </div>
      </div>
      <div class="container">
          <div class="support-form">
              <div class="form">
                  <form action="{{ route('web.pages.contact-us') }}" method="post" class="needs-validation" novalidate>
                      @csrf

                      @include('components.errors')

                      @php
                      $user = Auth::user() ?? new \App\Models\User();
                      @endphp

                      <div class="row">
                          <div class="py-3 col-12 col-md-6">
                              <input type="text" placeholder="@lang('First Name')" name="first_name"
                                  value="{{ $user->name }}" required>
                              <div class="invalid-feedback">
                                  @lang('The first name field is required.')
                              </div>
                          </div>
                          <div class="py-3 col-12 col-md-6">
                              <input type="text" placeholder="@lang('Last Name')" name="last_name">
                              <div class="invalid-feedback">
                                  @lang('The last name field is required.')
                              </div>
                          </div>

                          <div class="py-3 col-12 col-md-6">
                              <input class="text-start" type="email" placeholder="@lang('Email')"
                                  value="{{ $user->email }}" required name="email">
                              <div class="invalid-feedback">
                                  @lang('The Email field is required.')
                              </div>
                          </div>
                          <div class="py-3 col-12 col-md-6">
                              <input type="text" placeholder="@lang('Phone')" required name="phone"
                                  value="{{ $user->phone }}">
                              <div class="invalid-feedback">
                                  @lang('The Phone field is required.')
                              </div>
                          </div>
                          
                          <div class="py-3 col-12 col-md-6">
                              <input type="text" placeholder="@lang('Required service')" name="capital">
                              <div class="invalid-feedback">
                                  @lang('The Your Capital field is required.')
                              </div>
                          </div>
                          <div class="py-3 col-12">
                              <textarea name="message" placeholder="@lang('Message Here')" required></textarea>
                              <div class="invalid-feedback">
                                  @lang('The Message field is required.')
                              </div>
                          </div>
                          <div class="py-3 col-12">
                              <button class="btn btn-primary" type="submit">@lang('Send Queries')</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>

  @push('script')
  @include('partials.validate')
  @endpush

  @push('style-lib')
  <style>
      /*QUERY SECTION*/
      .section-title h5 {
          font-size: 20px;
          color: var(--wc);
          margin-top: 0px;
          text-transform: uppercase;
      }

      .support-bg {
          height: 523px;
          background: var(--sc);
          background-attachment: scroll;
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center;
      }

      .support-bg .section-title h2 {
          color: var(--wc)
      }

      .support-bg .section-title p {
          color: var(--wc)
      }

      .support-form {
          max-width: 1033px;
          margin: 0 auto;
          background: rgba(242, 242, 242, 0.73);
          border-radius: 15px;
          padding: 20px;
          margin-top: -320px;
      }

      .support-form input {
          width: 100%;
          box-shadow: 10px 10px 15px -10px rgba(0, 0, 0, 0.25);
          border-radius: 3px;
          border: none;
          padding: 10px;
          outline: none;
          padding: 20px;
          background: var(--wc);
      }

      .support-form input::placeholder {
          font-weight: 500;
          color: #555555;
          font-size: 16px;
      }

      .support-form textarea {
          width: 100%;
          box-shadow: 10px 10px 15px -10px rgba(0, 0, 0, 0.25);
          border-radius: 3px;
          border: none;
          padding: 10px;
          height: 160px;
          outline: none;
          padding: 23px;
          background: var(--wc);
      }

      .support-form textarea::placeholder {
          font-weight: 500;
          color: #555555;
          font-size: 16px;
      }

      .custom-btn.support-btn {
          border-radius: 3px;
      }

      .query-title h2 {
          font-weight: 400;
          font-size: 40px;
          line-height: 60px;
          color: var(--wc);
      }

      .query-title p {
          max-width: 450px;
          margin: 0 auto;
          color: var(--wc);
          text-align: center;
      }
  </style>
  @endpush
