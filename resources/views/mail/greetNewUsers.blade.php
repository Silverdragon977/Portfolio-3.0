<x-mail::message>
# Welcome to My Portfolio

Hi {{ $user->name }},

Thanks for creating an account on my portfolio website.

You can now:

- Access exclusive features
- Track your activity
- Connect directly with me

<x-mail::button :url="url('/dashboard')">
Visit Dashboard
</x-mail::button>

If you did not create this account, please ignore this email.

Thanks,  
- Michael Howard @ bemidjicsclub.com
</x-mail::message>