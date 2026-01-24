<?php

namespace App\Application\Controllers;

use App\Core\Http\Request;

class SecurityTestController
{
    public function index()
    {
        return render('security_test', ['title' => 'Security Lab']);
    }

    public function handleUnsafe()
    {
        // This method should NOT be reached if middleware works effectively, 
        // OR it will be reached if we purposefully don't apply middleware.
        echo "<div style='background: #fee2e2; color: #b91c1c; padding: 2rem; font-family: sans-serif; text-align: center; margin: 2rem auto; max-width: 600px; border-radius: 10px; border: 2px solid #b91c1c;'>";
        echo '<svg style="width: 48px; height: 48px; margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
        echo "<h1 style='font-size: 1.5rem; font-weight: bold; margin-bottom: 0.5rem;'>VULNERABILITY EXPLOITED!</h1>";
        echo "<p>This form request was processed <strong>WITHOUT</strong> checking for a CSRF token.</p>";
        echo "<p>An attacker could have submitted this form on your behalf.</p>";
        echo "<a href='/security-test' style='display: inline-block; margin-top: 1rem; color: #b91c1c; text-decoration: underline;'>Try the Secure Version &rarr;</a>";
        echo "</div>";
    }

    public function handleSafe()
    {
        // This method is PROTECTED by 'csrf' middleware
        echo "<div style='background: #dcfce7; color: #166534; padding: 2rem; font-family: sans-serif; text-align: center; margin: 2rem auto; max-width: 600px; border-radius: 10px; border: 2px solid #166534;'>";
         echo '<svg style="width: 48px; height: 48px; margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        echo "<h1 style='font-size: 1.5rem; font-weight: bold; margin-bottom: 0.5rem;'>SECURE REQUEST</h1>";
        echo "<p>This request was successfully validated with a generic CSRF token.</p>";
        echo "<a href='/security-test' style='display: inline-block; margin-top: 1rem; color: #166534; text-decoration: underline;'>&larr; Back to Lab</a>";
        echo "</div>";
    }
}
