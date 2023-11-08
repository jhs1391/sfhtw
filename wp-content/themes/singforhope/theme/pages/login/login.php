<?php
/*
Template Name: Static Login Template
*/

get_header();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $user = get_user_by('email', $email);
    
    if ($user) {
        // Generate a unique login token
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        update_user_meta($user->ID, 'login_token', $token);

        // Send email with login link
        $login_link = add_query_arg(array(
            'user_id' => $user->ID,
            'login_token' => $token,
        ), home_url());
        wp_mail($email, 'Login Link', 'Click here to log in: ' . $login_link);
        
        echo "We've sent you an email with a login link.";
    } else {
        echo "No user found with that email address.";
    }
} elseif (isset($_GET['user_id']) && isset($_GET['login_token'])) {
    $user = get_user_by('id', $_GET['user_id']);
    if ($user && get_user_meta($user->ID, 'login_token', true) === $_GET['login_token']) {
        // Log the user in and redirect to home page
        clean_user_cache($user->ID);
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, true);
        update_user_meta($user->ID, 'login_token', ''); // Clear the token
        wp_redirect(home_url());
        exit;
    }
}
?>

<section id="primary">
    <main id="main">

    <div class="w-full max-w-md mx-auto p-6">
      <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 sm:p-7">
          

          <?php if(is_user_logged_in()): ?>
              <h3>You are already logged in.</h3>
          <?php else: ?>

            <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>
          </div>

            <!-- Form -->
            <form method="POST">
                <div class="grid gap-y-4">
                    <!-- Form Group -->
                    <div>
                    <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" required aria-describedby="email-error">
                    </div>
                    </div>
                    <!-- End Form Group -->

                    <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">Send Login Link</button>
                </div>
            </form>
            <!-- End Form -->
        
         <?php endif; ?>

        </div>
      </div>
</div>
</html>

    </main>
</section>


<?php
get_footer();
