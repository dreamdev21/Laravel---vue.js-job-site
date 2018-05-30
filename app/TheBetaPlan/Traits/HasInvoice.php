<?php

namespace App\TheBetaPlan\Traits;

use App\Models\Invoice;
use Ramsey\Uuid\Uuid;

trait HasInvoice
{
    public function invoice()
    {
        return $this->morphMany(Invoice::class, 'entity')->latest();
    }

    public function generateInvoiceName()
    {
        return strtoupper($this->name);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getTax()
    {
        // @TODO replace this tax function later when we apply tax to invoices
        return 0;
    }

    public function getInvoiceCustomerId()
    {
        return null;
    }

    public function getInvoiceDueDate()
    {
        return now()->addDays(3);
    }

    public function createInvoice()
    {
        $invoice = new Invoice(['name' => $this->generateInvoiceName()]);
        $invoice->amount = $this->getAmount();
        $invoice->tax = $this->getTax();
        $invoice->invoice_number = (string)Uuid::uuid4();
        $invoice->customer_id = $this->getInvoiceCustomerId();
        $invoice->due_on = $this->getInvoiceDueDate();
        $this->invoice()->save($invoice);
        return $this;
    }

    public function getInvoiceAttribute()
    {
        return $this->invoice()->first();
    }
}
