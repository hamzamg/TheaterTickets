<?php

namespace App\Services;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrCodeService
{
    /**
     * Generate a QR code as SVG string
     *
     * @param string $data The data to encode
     * @param int $size The size of the QR code
     * @return string SVG string
     */
    public static function generateSvg(string $data, int $size = 200): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle($size),
            new SvgImageBackEnd()
        );
        
        $writer = new Writer($renderer);
        return $writer->writeString($data);
    }

    /**
     * Generate a booking QR code
     *
     * @param int $bookingId
     * @param string $clientName
     * @param string $showName
     * @param string $ticketCode
     * @return string SVG string
     */
    public static function generateBookingQr(
        int $bookingId,
        string $clientName,
        string $showName,
        string $ticketCode
    ): string {
        $data = json_encode([
            'booking_id' => $bookingId,
            'client' => $clientName,
            'show' => $showName,
            'ticket' => $ticketCode,
            'verified' => true,
        ]);
        
        return self::generateSvg($data, 300);
    }

    /**
     * Generate a simple ticket verification QR
     *
     * @param string $code
     * @return string
     */
    public static function generateTicketQr(string $code): string
    {
        return self::generateSvg("TICKET:$code", 250);
    }
}