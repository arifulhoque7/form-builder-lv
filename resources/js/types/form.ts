export interface FormField {
    type: string;
    name: string;
    label: string;
    placeholder?: string;
    required: boolean;
    validation_rules?: Record<string, any>;
    order: number;
    options?: Record<string, any>;
}

export interface Form {
    id?: number;
    title: string;
    method: string;
    action?: string;
    configuration?: Record<string, any>;
    is_active: boolean;
    fields: FormField[];
}

export interface FormFieldOption {
    label: string;
    value: string | number;
}

export interface ValidationRule {
    type: string;
    message: string;
    value?: any;
} 