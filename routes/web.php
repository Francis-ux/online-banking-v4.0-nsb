<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Dashboard\User\CardController;
use App\Http\Controllers\Dashboard\Admin\LoanController;
use App\Http\Controllers\Dashboard\Master\AdminController;
use App\Http\Controllers\Dashboard\User\DepositController;
use App\Http\Controllers\Dashboard\User\ProfileController;
use App\Http\Controllers\Dashboard\User\TransferController;
use App\Http\Controllers\Dashboard\User\DashboardController;
use App\Http\Controllers\Dashboard\User\TransactionController;
use App\Http\Controllers\Dashboard\Admin\UserAccountController;
use App\Http\Controllers\Dashboard\Admin\UserDepositController;
use App\Http\Controllers\Dashboard\Admin\UserProfileController;
use App\Http\Controllers\Dashboard\User\NotificationController;
use App\Http\Controllers\Dashboard\Admin\ContactMessageController;
use App\Http\Controllers\Dashboard\Admin\UserWithdrawalController;
use App\Http\Controllers\Dashboard\Admin\UserTransactionController;
use App\Http\Controllers\Dashboard\User\AccountStatementController;
use App\Http\Controllers\Dashboard\Admin\UserNotificationController;
use App\Http\Controllers\Dashboard\Admin\UserVerificationController;
use App\Http\Controllers\Dashboard\Admin\VerificationCodeController;
use App\Http\Controllers\Dashboard\User\EmailVerificationController;
use App\Http\Controllers\Dashboard\User\DirectBankTransferController;
use App\Http\Controllers\Dashboard\User\ElectronicTransferController;
use App\Http\Controllers\Dashboard\User\ValidateTransferCodeController;
use App\Http\Controllers\Dashboard\Admin\UserAccountStateSettingController;
use App\Http\Controllers\Dashboard\Admin\CardController as AdminCardController;
use App\Http\Controllers\Dashboard\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Dashboard\Master\ProfileController as MasterProfileController;
use App\Http\Controllers\Dashboard\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dashboard\Master\DashboardController as MasterDashboardController;
use App\Http\Controllers\Dashboard\User\DomesticTransferController;
use App\Http\Controllers\Dashboard\User\InternationalTransferController;
use App\Http\Controllers\Dashboard\User\WireTransferController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/store', [PageController::class, 'contactStore'])->name('contact.store');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/loan', [PageController::class, 'loan'])->name('loan');
Route::post('/loan/store', [PageController::class, 'loanStore'])->name('loan.store');

Route::middleware('user')->name('user.')->prefix('user')->group(function () {
    // Email verification controller routes
    Route::get('/email/verification', [EmailVerificationController::class, 'index'])->name('email.verification');
    Route::post('/email/verification/store', [EmailVerificationController::class, 'store'])->name('email.verification.store');
    Route::get('/email/verification/resend', [EmailVerificationController::class, 'resend'])->name('email.verification.resend');
    //Dashboard controller routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Profile controller
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::post('/profile/upload/front/id', [ProfileController::class, 'uploadFrontId'])->name('profile.upload.front.id');
    Route::post('/profile/upload/back/id', [ProfileController::class, 'uploadBackId'])->name('profile.upload.back.id');
    Route::get('/profile/request/validation', [ProfileController::class, 'requestValidation'])->name('profile.request.validation');
    // Transfers
    Route::get('/transfer/index', [TransferController::class, 'index'])->name('transfer.index');
    Route::get('/transfer/fund', [TransferController::class, 'transferFund'])->name('transfer.fund');
    Route::get('/transfer/preview/{referenceId}', [TransferController::class, 'preview'])->name('transfer.preview');
    Route::get('/transfer/confirm/{referenceId}', [TransferController::class, 'confirm'])->name('transfer.confirm');
    Route::get('/transfer/process/{referenceId}/{orderNo}', [TransferController::class, 'process'])->name('transfer.process');
    Route::post('/transfer/code/validate/{referenceId}/{orderNo}', [ValidateTransferCodeController::class, 'store'])->name('transfer.code.validate');
    Route::get('/transfer/show/{referenceId}', [TransferController::class, 'show'])->name('transfer.show');
    Route::get('/transfer/print/{uuid}', [TransferController::class, 'print'])->name('transfer.print');
    Route::post('/international/transfer', [InternationalTransferController::class, 'store'])->name('international.transfer');
    Route::post('/domestic/transfer', [DomesticTransferController::class, 'store'])->name('domestic.transfer');
    Route::post('/wire/transfer', [WireTransferController::class, 'store'])->name('wire.transfer');
    Route::get('/wire/transfer/get/account/number', [WireTransferController::class, 'getAccountNumber'])->name('wire.transfer.get.account.number');
    // Transactions
    Route::get('/transaction/index', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/show/{uuid}', [TransactionController::class, 'show'])->name('transaction.show');
    Route::get('/transaction/print/{uuid}', [TransactionController::class, 'print'])->name('transaction.print');
    // Notification
    Route::get('/notification/index', [NotificationController::class, 'index'])->name('notification.index');
    // Deposit
    Route::get('/deposit/index', [DepositController::class, 'index'])->name('deposit.index');
    Route::get('/deposit/card', [DepositController::class, 'card'])->name('deposit.card');
    Route::post('/deposit/card/store', [DepositController::class, 'cardStore'])->name('deposit.card.store');
    Route::get('/deposit/bitcoin', [DepositController::class, 'bitcoin'])->name('deposit.bitcoin');
    Route::post('/deposit/bitcoin/store', [DepositController::class, 'bitcoinStore'])->name('deposit.bitcoin.store');
    Route::get('/deposit/show/{uuid}', [DepositController::class, 'show'])->name('deposit.show');
    Route::post('/deposit/upload/proof/{uuid}', [DepositController::class, 'uploadProof'])->name('deposit.upload.proof');
    Route::get('/deposit/history', [DepositController::class, 'history'])->name('deposit.history');
    // card
    Route::get('/card/index', [CardController::class, 'index'])->name('card.index');
    Route::post('/card/store', [CardController::class, 'store'])->name('card.store');
    // Account Statement
    Route::get('/account/statement/index', [AccountStatementController::class, 'index'])->name('account.statement.index');
    Route::post('/account/statement/store', [AccountStatementController::class, 'store'])->name('account.statement.store');
    Route::get('/account/statement/show/{from}/{to}', [AccountStatementController::class, 'show'])->name('account.statement.show');
    Route::get('/account/statement/download/{from}/{to}', [AccountStatementController::class, 'download'])->name('account.statement.download');
});
Route::middleware('admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    // User controller routes
    Route::get('/users/account/verified', [UserAccountController::class, 'verified'])->name('users.account.verified');
    Route::get('/users/account/unverified', [UserAccountController::class, 'unverified'])->name('users.account.unverified');
    Route::get('/users/account/disabled', [UserAccountController::class, 'disabled'])->name('users.account.disabled');
    Route::get('/users/account/all', [UserAccountController::class, 'all'])->name('users.account.all');
    // User profile controller
    Route::get('/users/profile/{uuid}', [UserProfileController::class, 'index'])->name('users.profile.index');
    Route::post('/users/profile/update/{uuid}', [UserProfileController::class, 'update'])->name('users.profile.update');
    Route::get('/users/profile/delete/{uuid}', [UserProfileController::class, 'delete'])->name('users.profile.delete');
    // Verification code
    Route::get('/verification/code/index', [VerificationCodeController::class, 'index'])->name('verification.code.index');
    Route::post('/verification/code/store', [VerificationCodeController::class, 'store'])->name('verification.code.store');
    Route::get('/verification/code/edit/{uuid}', [VerificationCodeController::class, 'edit'])->name('verification.code.edit');
    Route::post('/verification/code/update/{uuid}', [VerificationCodeController::class, 'update'])->name('verification.code.update');
    Route::get('/verification/code/delete/{uuid}', [VerificationCodeController::class, 'delete'])->name('verification.code.delete');
    // User withdrawal controller routes
    Route::get('/users/withdrawal/index/{uuid}', [UserWithdrawalController::class, 'index'])->name('users.withdrawal.index');
    Route::get('/users/withdrawal/show/{uuid}/{referenceId}', [UserWithdrawalController::class, 'show'])->name('users.withdrawal.show');
    Route::post('/users/withdrawal/update/{uuid}/{referenceId}', [UserWithdrawalController::class, 'update'])->name('users.withdrawal.update');
    Route::get('/users/withdrawal/delete/{transferUuid}', [UserWithdrawalController::class, 'delete'])->name('users.withdrawal.delete');
    // User Transactions
    Route::get('/users/transaction/index/{uuid}', [UserTransactionController::class, 'index'])->name('users.transaction.index');
    Route::post('/users/transaction/store/{uuid}', [UserTransactionController::class, 'store'])->name('users.transaction.store');
    Route::get('/users/transaction/delete/{uuid}', [UserTransactionController::class, 'delete'])->name('users.transaction.delete');
    Route::get('/users/transaction/print/{user}/{transaction}', [UserTransactionController::class, 'print'])->name('users.transaction.print');
    // User Setting
    Route::get('/users/account/state/setting/index/{uuid}', [UserAccountStateSettingController::class, 'index'])->name('users.account.state.setting.index');
    Route::post('/users/account/state/setting/update/{uuid}', [UserAccountStateSettingController::class, 'update'])->name('users.account.state.setting.update');
    // User verification status
    Route::get('/users/verification/skip/{uuid}', [UserVerificationController::class, 'skip'])->name('users.verification.skip');
    Route::get('/users/verification/set/{uuid}', [UserVerificationController::class, 'set'])->name('users.verification.set');
    // User notification
    Route::get('/users/notification/index/{uuid}', [UserNotificationController::class, 'index'])->name('users.notification.index');
    Route::get('/users/notification/delete/{uuid}', [UserNotificationController::class, 'delete'])->name('users.notification.delete');
    Route::post('/users/notification/send/{uuid}', [UserNotificationController::class, 'send'])->name('users.notification.send');
    // User deposit
    Route::get('/users/deposit/index/{uuid}', [UserDepositController::class, 'index'])->name('users.deposit.index');
    Route::get('/users/deposit/show/{user}/{deposit}', [UserDepositController::class, 'show'])->name('users.deposit.show');
    Route::get('/users/deposit/confirm/{user}/{deposit}', [UserDepositController::class, 'confirm'])->name('users.deposit.confirm');
    Route::get('/users/deposit/delete/{user}/{deposit}', [UserDepositController::class, 'delete'])->name('users.deposit.delete');
    // Loans
    Route::get('/loan/index', [LoanController::class, 'index'])->name('loan.index');
    Route::get('/loan/show/{uuid}', [LoanController::class, 'show'])->name('loan.show');
    Route::get('/loan/delete/{uuid}', [LoanController::class, 'delete'])->name('loan.delete');
    // Contact messages
    Route::get('/contact/message/index', [ContactMessageController::class, 'index'])->name('contact.message.index');
    Route::get('/contact/message/show/{uuid}', [ContactMessageController::class, 'show'])->name('contact.message.show');
    Route::get('/contact/message/delete/{uuid}', [ContactMessageController::class, 'delete'])->name('contact.message.delete');
    // Cards
    Route::get('/card/index', [AdminCardController::class, 'index'])->name('card.index');
    Route::get('/card/show/{uuid}', [AdminCardController::class, 'show'])->name('card.show');
    Route::get('/card/delete/{uuid}', [AdminCardController::class, 'delete'])->name('card.delete');
    // Admin Profile
    Route::get('/profile/index', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update/{uuid}', [AdminProfileController::class, 'update'])->name('profile.update');
});
Route::middleware('master')->name('master.')->prefix('master')->group(function () {
    Route::get('/dashboard', [MasterDashboardController::class, 'dashboard'])->name('dashboard');
    // Admin
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{uuid}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{uuid}', [AdminController::class, 'update'])->name('admin.update');
    // Profile Controller
    Route::get('/profile/index', [MasterProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [MasterProfileController::class, 'update'])->name('profile.update');
});


require __DIR__ . '/auth.php';
