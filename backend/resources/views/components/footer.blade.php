<footer class="text-gray-600 body-font">
  <div class="w-full sm:py-10 mx-auto sm:flex items-center">
    <div class="ml-4 text-center">
      <div class="flex">
          <img loading="lazy" width="50" height="50" srcset="{{ asset('images/icon_min.webp') }} 600w, {{ asset('images/icon.webp') }} 1024w" class="lazyload h-14 sm:mr-4 sm:pt-2">
          <img loading="lazy" width="114" height="64" srcset="{{ asset('images/logo_min.webp') }} 600w, {{ asset("images/logo.webp") }} 1024w" class="lazyload h-16  ml-4">
      </div>
      <p class="mt-2 text-sm text-gray-500">あなたの好きが、「たまり場」を創る。</p>
    </div>
    <div class="flex flex-wrap text-center mt-4 sm:pt-20">
      <div class="w-full px-4">
        <nav class="list-none mb-10 flex flex-wrap">
          <li>
            <a href="{{ route('user.inquiry') }}" class="text-gray-600 hover:text-gray-800">お問い合わせ</a>
          </li>
          <li>
            <a href="{{ route('user.terms_of_service') }}" class="text-gray-600 hover:text-gray-800 ml-4">利用規約</a>
          </li>
          <li>
            <a href="{{ route('user.privacy_policy') }}" class="text-gray-600 hover:text-gray-800 ml-4">プライバシーポリシー</a>
          </li>
        </nav>
      </div>
    </div>
  </div>
  <div class="bg-gray-100">
    <div class="container mx-auto py-4 px-5">
      <p class="text-gray-500 text-sm text-center">Copyright © Tamari-Ba 2022 Rights Reserved.</p>
    </div>
  </div>
</footer>
