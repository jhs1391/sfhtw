<div class="flex flex-row">
	<div class="flex w-[200px] bg-gray-200 rounded">
		Email Log
	</div>
	<div class="flex-grow">
		<div class="px-4 sm:px-6 lg:px-8">
			<div class="sm:flex sm:items-center">
				<div class="sm:flex-auto">
					<h1 class="text-base font-semibold leading-6 text-gray-900">Email Log</h1>
					<p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name,
						title, email, and role.</p>
				</div>
				<div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
					<button type="button"
						class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
						user</button>
				</div>
			</div>

			<form method="POST">
				<div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
					<button type="submit"
						class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
						Add user
					</button>
				</div>
			</form>

			<div class="flow-root mt-8">
				<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
					<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
						<table class="min-w-full">
							<thead class="bg-white">
								<tr>
									<th scope="col"
										class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
										Time</th>
									<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
										Recipient</th>
									<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
										Context</th>
									<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
										Subject</th>
									<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
										Status</th>
									<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
										<span class="sr-only">View</span>
									</th>
								</tr>
							</thead>
							<tbody class="bg-white">

								<?php
								if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
									$to = 'javiereh@pm.me';
									$subject = 'The subject';

									// Path to email template
									$template_path = get_template_directory() . '/emails/email-template.php';

									// Check if the template file exists
									if ( file_exists( $template_path ) ) {
										// Fetch the contents of the template file
										ob_start();
										include $template_path;
										$body = ob_get_clean();
									} else {
										// Fallback content if the template file doesn't exist
										$body = 'The email body content';
									}

									$headers = array( 'Content-Type: text/html; charset=UTF-8' );

									wp_mail( $to, $subject, $body, $headers );
								}

								global $wpdb;
								$results = $wpdb->get_results( "
                                    SELECT *
                                    FROM wp_wpmailsmtp_emails_log
                                    WHERE 1=1
                                    ORDER BY date_sent DESC, id DESC
                                    LIMIT 0, 10
                                " );

								if ( ! empty( $results ) ) {
									foreach ( $results as $row ) {
										$people = json_decode( $row->people, true );
										$email = isset( $people['to'][0] ) ? $people['to'][0] : '';
										$time_sent = strtotime( $row->date_sent );
										$human_time = human_time_diff( $time_sent, current_time( 'timestamp' ) ) . ' ago';
										echo '
                        <tr class="border-t border-gray-300">
                                                       <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-3"><span title="' . esc_attr( $row->date_sent ) . '">' . esc_html( $human_time ) . '</span></td>

                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">' . esc_html( $email ) . '</td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">' . esc_html( $row->context ) . '</td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">' . esc_html( $row->subject ) . '</td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">' . esc_html( $row->status ) . '</td>
                            <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-3"><a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a></td>
                        </tr>
                    ';
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>