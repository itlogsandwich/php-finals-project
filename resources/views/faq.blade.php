<x-layouts.main>
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: #f7f7f0; /* Matches the background in the image */
            border: 1px solid #ccc;
        }
        h2 {
            color: #384d38; /* Dark Green from header */
            border-bottom: 2px solid #5a7a5a;
            padding-bottom: 5px;
            margin-top: 30px;
        }
        h3 {
            color: #5a7a5a;
            margin-top: 20px;
        }
        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        li {
            margin-bottom: 10px;
        }
        p strong {
            color: #384d38;
        }
        .section-separator {
            border: 0;
            height: 1px;
            background-color: #ccc;
            margin: 30px 0;
        }
    </style>

    <div class="container">

        <header>
            <h2>🔒 Operational Security (OpSec) Guide for Phantom Route</h2>
        </header>
        <p>Maintaining strong **OpSec** is **critical** for your safety and anonymity on Phantom Route. These principles are non-negotiable for all users and are your first line of defense.</p>

        <hr class="section-separator">

        <h3>I. 💻 Digital Environment: System Separation</h3>
        <ul>
            <li><strong>Dedicated OS:</strong> Never access the marketplace from your primary, day-to-day operating system (OS). Use a **Tails OS** (a live operating system that boots from a USB stick and routes all connections through Tor) or a secure, segregated Virtual Machine (VM). </li>
            <li><strong>Tor Browser Only:</strong> Access Phantom Route **exclusively** through the **official Tor Browser**. Configure Tor to the highest security settings and **never** use standard browsers (Chrome, Firefox, etc.) or clear net connections.</li>
            <li><strong>No Scripts/Plugins:</strong> Disable JavaScript and all browser plugins within Tor Browser. These can often be exploited to reveal identifying information.</li>
            <li><strong>VPN as an Extra Layer (Optional):</strong> While Tor provides robust anonymity, some users choose to tunnel their entire connection through a **trusted, zero-log VPN** <em>before</em> opening Tor.</li>
        </ul>

        <hr>

        <h3>II. 📧 Communication and Encryption</h3>
        <ul>
            <li><strong>PGP/GPG Mandatory:</strong> All communications that include sensitive information (e.g., shipping addresses, tracking numbers, personal negotiations) **must** be encrypted using **Pretty Good Privacy (PGP)** or **GNU Privacy Guard (GPG)**.
                <ul>
                    <li><strong>Public Keys:</strong> Share your public key with sellers/buyers.</li>
                    <li><strong>Encryption:</strong> Encrypt the message using the recipient's public key.</li>
                    <li><strong>Signing:</strong> Sign your messages with your own private key to prove authenticity.</li>
                </ul>
            </li>
            <li><strong>Never Store Private Keys Online:</strong> Your private PGP key must be stored securely offline (e.g., on an encrypted USB stick) and **never** on a networked drive or cloud service.</li>
            <li><strong>Decoy/Disposable Information:</strong> Use temporary or disposable email accounts (if needed for communication outside the platform) and fictitious account details.</li>
        </ul>

        <hr>

        <h3>III. 💰 Financial and Transaction OpSec</h3>
        <ul>
            <li><strong>Cryptocurrency Mixer/Tumbler:</strong> Before sending cryptocurrency (e.g., Bitcoin) to fund your marketplace wallet, consider passing it through a **coin mixer or tumbler**. This severs the link between the coins originating from an exchange and the coins arriving at the marketplace. </li>
            <li><strong>Secure Withdrawal/Deposit:</strong> Always double-check deposit addresses. Only initiate transactions when your OpSec setup (Tor, OS separation) is fully operational.</li>
            <li><strong>Escrow Protocol:</strong> Utilize the Phantom Route **Escrow Service** for every transaction. **Avoid** "Finalize Early" (FE) unless you have established a strong, verified trust relationship with the vendor.</li>
        </ul>

        <hr>

        <h3>IV. 📦 Physical and Real-World OpSec</h3>
        <ul>
            <li><strong>Shipping Address:</strong>
                <ul>
                    <li><strong>Encryption:</strong> The shipping address must *only* be transmitted to the vendor after it has been fully **PGP-encrypted**.</li>
                    <li><strong>Mail Drop:</strong> Never use your primary home or work address. Use a secure **mail drop**, P.O. Box, or a location where you have established a controlled, non-identifiable receiving arrangement.</li>
                </ul>
            </li>
            <li><strong>Avoid Digital Footprints:</strong> Do not discuss your purchases or sales on social media, public forums, or unencrypted chat applications.</li>
            <li><strong>Physical Evidence:</strong> Be mindful of disposing of packaging, receipts, and any physical evidence that could link you to a shipment.</li>
        </ul>

        <hr class="section-separator">
        <hr class="section-separator">

        <header>
            <h2>📜 Phantom Route Terms of Service (ToS)</h2>
        </header>
        <p>This document outlines the operational guidelines and principles governing the use of the Phantom Route marketplace. By accessing or using our services, you acknowledge and agree to be bound by these terms.</p>

        <hr class="section-separator">

        <h3>I. Core Philosophy: Anonymity and Freedom</h3>
        <ol>
            <li><strong>Commitment to Anonymity:</strong> Phantom Route is built upon a strict commitment to user privacy and anonymity. We employ technological and procedural safeguards designed to minimize the collection and retention of identifying data.</li>
            <li><strong>User Responsibility for OpSec (Operational Security):</strong> Users bear the **sole responsibility** for their own operational security (OpSec).</li>
            <li><strong>Freedom of Trade:</strong> The platform operates under a principle of maximal freedom of commerce. Listings are diverse and may include goods and services that are restricted, regulated, or prohibited in various jurisdictions. Phantom Route does not moderate based on the legality of a product or service.</li>
        </ol>

        <hr>

        <h3>II. Account Registration and Usage</h3>
        <ol>
            <li><strong>Account Security:</strong> Users are responsible for all activities that occur under their account. **Sharing account credentials is strictly prohibited.**</li>
            <li><strong>Minimum Information:</strong> Account creation requires minimal, non-identifying information necessary for internal operation. Users are encouraged to provide fictitious or disposable usernames and credentials.</li>
            <li><strong>Prohibited Activities:</strong> Activities that directly compromise the integrity or stability of the platform itself are prohibited (e.g., Phishing, DDoS attacks).</li>
        </ol>

        <hr>

        <h3>III. Transactions and Payment</h3>
        <ol>
            <li><strong>Currency:</strong> All transactions utilize cryptocurrency (specified on the platform). Users must understand the risks associated with volatile digital currencies.</li>
            <li><strong>Escrow Service:</strong> Phantom Route provides a multi-signature escrow system to protect both buyers and sellers.</li>
            <li><strong>Finalization and Dispute Resolution:</strong> Buyers must **"Finalize"** a transaction promptly. Disputes are handled via an arbitration process requiring verifiable, encrypted evidence.</li>
            <li><strong>"Finalize Early" (FE):</strong> FE transactions carry a **higher risk to the buyer** and are conducted at the buyer's own risk.</li>
        </ol>

        <hr>

        <h3>IV. Disclaimer of Liability</h3>
        <ol>
            <li><strong>"As Is" Service:</strong> Phantom Route is provided on an **"as is"** and **"as available"** basis.</li>
            <li><strong>No Legal Sanctuary:</strong> Users acknowledge that utilizing the platform for illegal activities does not confer legal protection. **Phantom Route is not a legal shield.** Users assume all legal and financial risks.</li>
            <li><strong>Indemnification:</strong> Users agree to indemnify and hold harmless Phantom Route and its operators from any claims arising from their use of the service.</li>
        </ol>

        <hr>

        <h3>V. Modification of Terms</h3>
        <p>Phantom Route reserves the right to modify these Terms of Service at any time. Continued use of the service after any such changes constitutes your acceptance of the new terms.</p>

    </div>

</x-layouts.main>