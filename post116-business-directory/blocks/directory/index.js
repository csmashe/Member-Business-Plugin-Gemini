/**
 * This file needs to be processed by @wordpress/scripts to generate the final JS file.
 * e.g., `npx wp-scripts build`
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import metadata from './block.json';

registerBlockType( metadata.name, {
    edit: () => {
        const blockProps = useBlockProps();
        return (
            <div { ...blockProps }>
                <p>Business Directory Placeholder</p>
            </div>
        );
    },
    // save: is handled by render.php
} );
